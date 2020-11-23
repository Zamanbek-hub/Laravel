<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Resumes;
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
       return view('resumes.index',['resumes'=>$resumes,'specialties'=>$specialties, 'student'=>$student]);   
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
     //  $resume->spec_id=request('spec_id');
       $resume->salary=request('salary');
       $resume->description=request('description');
       $resume->view_count=0;
       $resume->resume_text=request('description');
       error_log($req   ->cookie('mycookie'));
   // здесь айди студента нужно взять из таблицы юзерс и 
   //проверить есть ли такой студент прежде чем добавить его резюме 

       $resume->student_id=1;
   
       $resume->save();

       $vacSkills= new Resume_skills();
       $vacSkills->skill_id=1;
       $vacSkills->resume_id=$resume->id;
       $vacSkills->save(); 

       $vacSkills1= new Resume_skills();
       $vacSkills1->skill_id=2;
       $vacSkills1->resume_id=$resume->id;
       $vacSkills1->save(); 

       error_log($resume);
       return redirect('/resume');   

   }

   public function show($id){
       $resume = Resumes::findOrFail($id);
       $specialties = DB::table('specialties')->get();
      // $roles = App\Models\Resumes::find(1)->specialties()->orderBy('name')->get();
    //    $specResumes=DB::table('specialty_resume')->where('resume_id',$id)->get();
    //    $arr=array();
    //    foreach($specResumes as $sp){
    //        if(Specialties::findOrFail($sp->specialty_id)){
    //         array_push(Specialties::where('specialty_id',$sp->specialty_id)->get(), $arr);
    //        }
    //    }
    //    error_log($arr);
      return view('resumes.show',['resume'=>$resume,'specialties'=>$specialties]);   
   }

   public function destroy($id){
       $resume = Resumes::findOrFail($id);

       $resume->delete();
      return redirect('/resume');   
   }

   public function update(){

       $resume = Resumes::find(request('id'));
       
       $resume->full_name=request('full_name');
       $resume->email=request('email');
       $resume->phone_number=request('phone_number');
       $resume->url_portfolio=request('url_portfolio');
    //   $resume->spec_id=request('spec_id');
       $resume->salary=request('salary');
       $resume->description=request('description');
       $resume->resume_text=request('description');
   
       $resume->save();
       error_log($resume);
       return redirect('/resume');   
   }
}
