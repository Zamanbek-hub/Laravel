<?php

namespace App\Http\Controllers;

use App\Models\Employers;
use App\Models\FavoriteResumes;
use App\Models\FavoriteVacancies;
use App\Models\Resumes;
use App\Models\Vacancies;
use App\Models\Selected_Resumes;
use App\Models\Students;
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
    public function index()
    {
        
        error_log(Auth::user()->name);
        error_log(Auth::user()->role);
        if(Auth::user()->role === 'student'){
            error_log("Student");
            $student = Students::where('user_id', Auth::user()->id)->firstOrFail();
            error_log($student);
            error_log("id=".$student->id);
            $resumes = Resumes::where('student_id', $student->id)->get();
            $vacancies = Vacancies::orderBy('id', 'desc')->take(3)->get();
            return view('home_students', ['resumes' => $resumes, 'vacancies' => $vacancies] );
        }
        else if(Auth::user()->role === 'employer'){
            error_log("Employer");
            $employer = Employers::where('user_id', Auth::user()->id)->firstOrFail();
            $resumes = Resumes::orderBy('id', 'desc')->take(3)->get();
            $vacancies = Vacancies::where('employer_id', $employer->id)->get();
            return view('home_employers', ['resumes' => $resumes, 'vacancies' => $vacancies] );
        }
        else {
            error_log("403");
            return view('403');
        }
    }

    public function selected_resumes(){
        if(Auth::user()->role === 'stude'){
            error_log("Student");
            $resumes = Resumes::where('employer_id', Auth::user()->id)->get();
            $vacancies = Vacancies::orderBy('id', 'desc')->take(3)->get();
            return view('home_students', ['resumes' => $resumes, 'vacancies' => $vacancies] );
        }
        else if(Auth::user()->role === 'employer'){
            error_log("Employer");
            $resumes = Resumes::orderBy('id', 'desc')->take(3)->get();
            $vacancies = Vacancies::where('employer_id', Auth::user()->id)->get();
            return view('home_employers', ['resumes' => $resumes, 'vacancies' => $vacancies] );
        }
        else {
            error_log("403");
            return view('403');
        }


        
    }


    public function favorites(){
        if(Auth::user()->role === 'student'){
            $favorites = FavoriteVacancies::where('user_id',Auth::user()->id)->get();
            return view('favorites', ['favorites' => $favorites] );

        }
        else if(Auth::user()->role === 'employer'){
            error_log("Employer");

            $favorites = FavoriteResumes::where('user_id',Auth::user()->id)->get();
            error_log($favorites);
            return view('favorites', ['favorites' => $favorites] );
        }
        else {
            error_log("403");
            return view('403');
        }
        
    }


    public function resume_pdf_view()
    {   
        error_log("WE are here");
        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com',
        //     'date' => date('m/d/Y')
        // ];
        return view('resumes.resume_pdf');
    }
}
