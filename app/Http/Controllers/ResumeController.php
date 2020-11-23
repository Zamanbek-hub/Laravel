<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Resumes;
use App\Models\Skills;
use App\Models\Students;
use App\Models\Specialties;
use App\Models\Resume_skills;
use App\Models\User;


class ResumeController extends Controller
{
    public function index(){
          // здесь айди студента нужно взять из таблицы юзерс и 
          
        $user= User::findOrFail(1);
        $student = Students::where('user_id',$user->id)->get();

        $resumes = Resumes::where('student_id',$student[0]->id)->get();
        
        $specialties = DB::table('specialties')->get();
       return view('resumes.index',compact('resumes'),[ 'student'=>$student]);   
   }


   public function create(){
       $specialties = DB::table('specialties')->orderBy('name','asc')->get();
       $user= User::findOrFail(1);
       $student = Students::where('user_id',$user->id)->get();
         
      return view('resumes.create',['specs'=>$specialties,'user'=>$user,'student'=>$student]);   
  }

  public function store(Request $req){

       $resume=new Resumes();
       $resume->full_name=request('full_name');
       $resume->email=request('email');
       $resume->phone_number=request('phone_number');
       $resume->url_portfolio=request('url_portfolio');
       $resume->salary=request('salary');
       $resume->description=request('description');
       $resume->view_count=0;
       $resume->resume_text=request('description');

       $resume->student_id=1;
   
       $resume->save();

       //many to many / instead of $skills we must get skills list from post method
       $skills = Skills::find([3, 4,1,2]);  
       $resume->skills()->attach($skills);

       $specs = Specialties::find([1,4,3]);  
       $resume->specialties()->attach($specs);

       error_log($resume);
       return redirect('/resume');   

   }

   public function show($id){
       $resume = Resumes::findOrFail($id);
       $specialties = DB::table('specialties')->get();

       return view('resumes.show',compact('resume'),['specialties'=>$specialties]);   
   }

   public function destroy($id){
       $resume = Resumes::findOrFail($id);

       foreach($resume->skills as $sk){
        $resume->skills()->detach($sk);
       }

       foreach($resume->specialties as $sp){
        $resume->specialties()->detach($sp);
       }
       $resume->delete();
      return redirect('/resume');   
   }

   public function update(){

       $resume = Resumes::find(request('id'));
      
       $resume->full_name=request('full_name');
       $resume->email=request('email');
       $resume->phone_number=request('phone_number');
       $resume->url_portfolio=request('url_portfolio');

       $resume->salary=request('salary');
       $resume->description=request('description');
       $resume->resume_text=request('description');
   
       $resume->save();
       error_log($resume);
       return redirect('/resume');   
   }
}
