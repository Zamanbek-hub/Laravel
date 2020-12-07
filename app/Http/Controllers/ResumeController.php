<?php

namespace App\Http\Controllers;

use App\Models\Favorite_Resumes;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Resumes;
use App\Models\Selected_Resumes;
use App\Models\Skills;
use App\Models\Students;
use App\Models\Specialties;
use App\Models\Resume_skills;
use App\Models\User;
use App\Models\Vacancies;

use PDF;


class ResumeController extends Controller
{
    public function index(){
          // здесь айди студента нужно взять из таблицы юзерс и 
          
        $user= User::findOrFail(1);
        $student = Students::where('user_id',$user->id)->get();

        $resumes = Resumes::where('student_id',$student[0]->id)->get();

        
        $count=0;
        $vacs=array();
        $vacancies = Vacancies::get();
        foreach($resumes as $res){
          foreach($res->specialties as $sp){
            for($i=0; $i<count($vacancies); $i++){
              foreach($vacancies[$i]->specialties as $spec){
                if($sp->id==$spec->id){
                    $count++;
                }
              }
              if($count>0){
                $c=0;
                for($j=0; $j<count($vacs); $j++){
                  if($vacs[$j]->id==$vacancies[$i]->id){
                    $c++;
                  }
                }
                if($c==0){
                  array_push($vacs, $vacancies[$i]);
                }
                $c=0;
              }
              $count=0;
            }
          }
        }

        

        
        $specialties = DB::table('specialties')->get();
       return view('resumes.index',['student'=>$student,'vacs'=>$vacs],compact('resumes'));   
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
    $resume->view_count=1;
    $resume->resume_text=request('description');
    $skills = request('skills');
    error_log("skills = ");   
    foreach ($skills as $skill) {
        error_log($skill);  
    }
   // здесь айди студента нужно взять из таблицы юзерс и 
   //проверить есть ли такой студент прежде чем добавить его резюме 

       $resume->student_id=1;
       
    //    $resume->save();

       //many to many / instead of $skills we must get skills list from post method
       $skills = Skills::find([3, 4,1,2]);  
       $resume->skills()->attach($skills);

       $specs = Specialties::find([1,4,3]);  
       $resume->specialties()->attach($specs);

       error_log($resume);
       return redirect('/home');   

   }

   public function show($id){
       $resume = Resumes::findOrFail($id);
       $specialties = DB::table('specialties')->get();

       return view('resumes.show',compact('resume'),['specialties'=>$specialties]);   
   }


   public function select(){
    $select = new Selected_Resumes();
    $select->request_text = 'fd';
    $select->seen_status = false;
    $select->vacancy_id = 1;
    $select->resume_id = request('resume_id');

    $select->save();
    return redirect('/home');
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
