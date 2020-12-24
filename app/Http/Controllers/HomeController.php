<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Resumes;
use App\Models\Skills;
use App\Models\Students;
use App\Models\Specialties;
use App\Models\Resume_skills;
use App\Models\User;
use App\Models\Vacancies;
use App\Models\Employers;

use App\Models\Selected_Resumes;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

        error_log(Auth::user()->name);
        error_log(Auth::user()->role);
        if(Auth::user()->role === 'student'){
            
            $user = User::findOrFail(Auth::user()->id);
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
            $vacanciesTop = Vacancies::orderBy('view_count','DESC')->skip(0)->take(5)->get();

            return view('resumes.index',['student'=>$student,'vacs'=>$vacs,'vacanciesTop'=>$vacanciesTop],compact('resumes'));  
        }
        else if(Auth::user()->role === 'employer'){
            $user = User::findOrFail(Auth::user()->id);
            
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
            $resumesTop = Resumes::orderBy('view_count','DESC')->skip(0)->take(5)->get();
            $specialties = DB::table('specialties')->get();
            return view('vacancies.index',compact('vacancies'),['employer'=>$employer,'specialties'=>$specialties,'resumes'=>$ress,'resumesTop'=>$resumesTop]);  
        }
        else if(Auth::user()->role === 'admin'){
              return view('admin.index');
        }
        else {
            error_log("403");
            return view('403');
        }
    }

    public function selected_resumes(){
        if(Auth::user()->role === 'stude'){
            error_log("Student");
            $resumes = Resumes::where('employer_id', auth()->user->id)->get();
            $vacancies = Vacancies::orderBy('id', 'desc')->take(3)->get();
            return view('home_students', ['resumes' => $resumes, 'vacancies' => $vacancies] );
        }
        else if(Auth::user()->role === 'employer'){
            error_log("Employer");
            $resumes = Resumes::orderBy('id', 'desc')->take(3)->get();
            $vacancies = Vacancies::where('employer_id', auth()->user->id)->get();
            return view('home_employers', ['resumes' => $resumes, 'vacancies' => $vacancies] );
        }
        else {
            error_log("403");
            return view('403');
        }


        
    }
}
