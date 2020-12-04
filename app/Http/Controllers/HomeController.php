<?php

namespace App\Http\Controllers;
use App\Models\Resumes;
use App\Models\Vacancies;
use App\Models\Selected_Resumes;

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
        $vacancies = Vacancies::orderBY('view_count', 'desc')->get();
        error_log($vacancies);
        $resumes = Resumes::orderBY('view_count', 'desc')->get();

        return view('home_employers', ['resumes' => $resumes, 'vacancies' => $vacancies] );
    }

    public function selected_resumes(){
        $selected = Selected_Resumes::where('resume_id');
        $resumes = Resumes::all();

        for($i =0; $i < count($resumes); $i++){

        }

        return view('home_employers', ['resumes' => $resumes, 'vacancies' => $vacancies] );
    }
}
