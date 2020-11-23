<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Employers;
use App\Models\User;
use App\Models\Skills;
use App\Models\Resumes;

use App\Models\Specialties;
use App\Models\Vacancies;


class VacancyController extends Controller{

    public function index(){
        $user = User::findOrFail(2);

        $employer = Employers::where('user_id',$user->id)->get();
        $vacancies = Vacancies::where('employer_id',$employer[0]->id)->get();

        $count=0;
        $ress=array();
        $resumeS = Resumes::get();
        foreach($vacancies as $vac){
          foreach($vac->specialties as $sp){
            for($i=0; $i<count($resumeS); $i++){
              foreach($resumeS[$i]->specialties as $spec){
                if($sp->id==$spec->id){
                    $count++;
                }
              }
              if($count>0){
                $c=0;
                for($j=0; $j<count($ress); $j++){
                  if($ress[$j]->id==$resumeS[$i]->id){
                    $c++;
                  }
                }
                if($c==0){

                  array_push($ress, $resumeS[$i]);
                }
                $c=0;
              }
              $count=0;
            }
          }
        }

        $specialties = DB::table('specialties')->get();
       return view('vacancies.index',compact('vacancies'),['employer'=>$employer,'resumes'=>$ress]);   
   }

   public function create(){
        $user = User::findOrFail(2);
        $employer = Employers::where('user_id',$user->id)->get();
        $specialties = DB::table('specialties')->orderBy('name','asc')->get();
        return view('vacancies.create',['emp'=>$employer,'specialties'=>$specialties,'user'=>$user]); 
   }

   public function store(){

        $vacancy=new Vacancies();
        $vacancy->name=request('name');
        $vacancy->surname=request('surname');
        $vacancy->email=request('email');
        $vacancy->phone_number=request('phone_number');
        $vacancy->description=request('description');
        $vacancy->salary=request('salary');
        $vacancy->view_count=0;
        $vacancy->employer_id=1;
        $ldate = date('Y-m-d H:i:s');
        $vacancy->created_at=$ldate;
        $vacancy->updated_at=$ldate;

        $vacancy->save();

        $skills = Skills::find([3, 4,2]);  
        $vacancy->skills()->attach($skills);

        $specs = Specialties::find([1,4,2]);  
        $vacancy->specialties()->attach($specs);
        error_log($vacancy);


        return redirect('/vacancy');   
    }

    public function show($id){
        $vacancy =Vacancies::findOrFail($id);
        $employer = Employers::findOrFail(1);
        $specialties = DB::table('specialties')->get();

       return view('vacancies.show',compact('vacancy'),['specialties'=>$specialties,'emp'=>$employer]);   
    }

    public function destroy($id){
        $vacancy = Vacancies::findOrFail($id);

        foreach($vacancy->skills as $sk){
            $vacancy->skills()->detach($sk);
         }

        foreach($vacancy->specialties as $sp){
            $vacancy->specialties()->detach($sp);
        }

        $vacancy->delete();
       return redirect('/vacancy');   
    }

    public function update(){

        $vacancy = Vacancies::find(request('id'));
        
        $vacancy->name=request('name');
        $vacancy->surname=request('surname');
        $vacancy->email=request('email');
        $vacancy->phone_number=request('phone_number');
        $vacancy->description=request('description');

        $vacancy->salary=request('salary');

        $vacancy->employer_id=1;
        $ldate = date('Y-m-d H:i:s');
        $vacancy->updated_at=$ldate;

        
        $vacancy->save();
              

        error_log($vacancy);

        return redirect('/vacancy');   
    }

}
