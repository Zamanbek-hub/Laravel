<?php

namespace App\Http\Controllers;

use App\Models\Resumes;
use Illuminate\Http\Request;
use PDF;
use Spipu\Html2Pdf\Html2Pdf;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    //


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resume_pdf()
    {   
        error_log("WE are here=".request('id'));
    
        $resume = Resumes::where('id', request('id'))->firstOrFail();
        error_log($resume);
        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com',
        //     'date' => date('m/d/Y')
        // ];
            
        // $html_str = view('resumes.resume_pdf')->render();
        // $html2pdf = new Html2Pdf();
        // $html2pdf->writeHTML($html_str);
        // $html2pdf->output('myPdf.pdf'); 
        // return $html2pdf->output('myPdf.pdf');
        $pdf = PDF::loadView('resumes.resume_pdf', ['resume'=>$resume]);
        return $pdf->download('resume.pdf');
    }


    public function resume_pdf_init(){
        $resume = Resumes::where('id', request('id'))->firstOrFail();
        $specialties = DB::table('specialties')->get();
 
        $pdf = PDF::loadView('resumes.resume_pdf_init',compact('resume'),['specialties'=>$specialties]);
        return $pdf->download('resume.pdf');   
    }


   
}
