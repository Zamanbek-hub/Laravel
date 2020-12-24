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
use App\Models\Vacancies;


class ResumeController extends Controller
{
    public function index(){
          
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='student'){
            $user = User::findOrFail($user_current->id);
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
                        if($count>0 && !in_array($vacancies[$i],$vacs)){
                                array_push($vacs, $vacancies[$i]);
                        }                        
                        $count=0;
                    }
                }
            }
            $specialties = DB::table('specialties')->get();
            $vacanciesTop = Vacancies::orderBy('view_count','DESC')->skip(0)->take(2)->get();

            return view('resumes.index',['student'=>$student,'vacs'=>$vacs,'vacanciesTop'=>$vacanciesTop],compact('resumes'));   
        }
    else{
        return view('home_without_reg');
    }
   }


   public function create(){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='student'){
            $user = User::findOrFail($user_current->id);
            $student = Students::where('user_id',$user->id)->get();
            $specialties = DB::table('specialties')->orderBy('name','asc')->get();
            
            return view('resumes.create',['specs'=>$specialties,'user'=>$user,'student'=>$student]);   
        }
        else{
            return view('403');
        }
  }

  public function store(){

    $user_current=auth()->user();
    if(!empty($user_current) && $user_current->role=='student'){
       $user = User::findOrFail($user_current->id);
       $student = Students::where('user_id',$user->id)->get();
       $resume=new Resumes();
       $resume->full_name=request('full_name');
       $resume->email=request('email');
       $resume->phone_number=request('phone_number');
       $resume->url_portfolio=request('url_portfolio');
       $resume->salary=request('salary');
       $resume->description=request('description');
       $resume->view_count=0;
       $resume->resume_text=request('description');
       $resume->student_id=$student[0]->id;
       $ldate = date('Y-m-d H:i:s');
       $resume->created_at=$ldate;
       $resume->updated_at=$ldate;
       $skills1 = request('skills');
       $specialties=request('specialties');
   
       $resume->save();
       
        if($specialties!=null){
            $specialties_in_db=new Specialties();               
            foreach($specialties as $spec){
                $specialties_in_db=Specialties::where('name',$spec)->get();
            $resume->specialties()->attach($specialties_in_db);
            }  
        }

        if($skills1!=null){    
            $skills_in_db=array();
            foreach ($skills1 as $skill) {
                $skill2=Skills::whereRaw('LOWER(name) = ?', strtolower($skill))->get();

                if(empty($skill2) || $skill2=="" ||$skill2==null || count($skill2)==0 ){
                    $n_skill=new Skills();
                    $n_skill->name=$skill;
                    $n_skill->save();
                    $resume->skills()->attach($n_skill);
                }
                else {
                    foreach($skill2 as $sk){
                        array_push($skills_in_db,$sk->id); 
                    }
                }
            }
            if(count($skills_in_db)!=0){
                $skills_in_db=array_unique($skills_in_db);
                foreach($skills_in_db as $sk){
                    $found_skill=new Skills();
                    $found_skill=Skills::findOrFail($sk);
                    $resume->skills()->attach($found_skill);
                }
            }
        }
       error_log($resume);
       return redirect('/home_s');   
    }
    else{
        return view('403');   
    }

   }

   public function show($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='student'){
            $user = User::findOrFail($user_current->id);

            $resume = Resumes::findOrFail($id);
            $student = Students::where('user_id',$user->id)->get();
            $specialties = DB::table('specialties')->get();
            $vacanciesTop = Vacancies::orderBy('view_count','DESC')->skip(0)->take(2)->get();

            $studentResumes=Resumes::where('student_id',$student[0]->id)->get();
            if($studentResumes!=null){
                $count=0;
                foreach($studentResumes as $res){
                    if($res->id==$id){
                        $count++;
                        break;
                    }
                }
                if($count==1){
                    return view('resumes.show',compact('resume'),['specialties'=>$specialties,'vacanciesTop'=>$vacanciesTop]); 
                }
            }
            return redirect('/home_s');
        }
        else{
            return view('403');  
        }  
   }

   public function destroy($id){
        $user_current=auth()->user();

        if(!empty($user_current) && $user_current->role=='student'){
            $user = User::findOrFail($user_current->id);
            
            $resume = Resumes::findOrFail($id);

            foreach($resume->skills as $sk){
                $resume->skills()->detach($sk);
            }

            foreach($resume->specialties as $sp){
                $resume->specialties()->detach($sp);
            }
            $resume->delete();
            return redirect('/home_s');
        }
        else{
            return view('403');   
        }   
   }

   public function update(){

       $resume = Resumes::findOrFail(request('id'));      
       $resume->full_name=request('full_name');
       $resume->email=request('email');
       $resume->phone_number=request('phone_number');
       $resume->url_portfolio=request('url_portfolio');
       $resume->salary=request('salary');
       $resume->description=request('description');
       $resume->resume_text=request('description');
       $ldate = date('Y-m-d H:i:s');
       $resume->updated_at=$ldate;
       $specsNew=request('specialties');
       $skillsNew=request('skills') ;

       $assignedSkills=request('assignedSkills');
       $assignedSpecs=request('assignedSpecs');

       if($assignedSpecs!=null){
           $specialties_assigned=new Specialties();    

           foreach($resume->specialties as $sp){
               if(!in_array($sp->name,$assignedSpecs)){
                       $resume->specialties()->detach($sp);
               }
           }
       }


       $specialties = DB::table('specialties')->get();
       $skills = DB::table('skills')->get();

       if($specialties!=null && $specsNew!=null){
           $specialties_to_assign=new Specialties();      
           foreach($specsNew as $spec){

               $specialties_to_assign=Specialties::where('name',$spec)->get();

               if($assignedSpecs!=null){
                   if(!in_array($spec, $assignedSpecs)){
                       $resume->specialties()->attach($specialties_to_assign);
                   }  
               }
               else{
                   $resume->specialties()->attach($specialties_to_assign);
               }
           }  
       }

       if($assignedSkills!=null){
           $skills_assigned=new Specialties();    
           $count=0;
           foreach($resume->skills as $sk){
               if(!in_array($sk->name,$assignedSkills)){
                       $resume->skills()->detach($sk);
               }
           }
       }

       if($skillsNew!=null && $skills!=null){    
           $skills_in_db=array();
           foreach ($skillsNew as $skill) {
                $skill2=Skills::whereRaw('LOWER(name) = ?', strtolower($skill))->get();

               if(empty($skill2) || $skill2=="" ||$skill2==null || count($skill2)==0){
                   $n_skill=new Skills();
                   $n_skill->name=$skill;
                   $n_skill->save();
                   $resume->skills()->attach($n_skill);
               }
               else {
                  foreach($skill2 as $sk){
                       array_push($skills_in_db,$sk->id); 
                  }
               }
           }
           if(count($skills_in_db)!=0){
               $skills_in_db=array_unique($skills_in_db);
               
               foreach($skills_in_db as $sk){
                   $found_skill=new Skills();
                   $found_skill=Skills::findOrFail($sk);
                   $resume->skills()->attach($found_skill);
               }
           }
       }
       $resume->save();
       error_log($resume);
       return redirect('/home_s');   
   }

      public function select(){
            $select = new Selected_Resumes();
            $select->request_text = 'fd';
            $select->seen_status = false;
            $select->vacancy_id = 1;
            $select->resume_id = request('resume_id');

            $select->save();
            return redirect('/home_s');
    }
}





  