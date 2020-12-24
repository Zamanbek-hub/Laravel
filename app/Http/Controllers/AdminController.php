<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancies;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.statistic');
    }

    
    public function vacancyStat()
    {    
        // $vacancies = Vacancies::orderBy('created_at', 'asc')->get()->groupBy('name');
        // error_log($vacancies);
        $vacancies = DB::table('vacancies as v')
                ->select(array(DB::Raw('count(v.id) as day_count'),DB::Raw('DATE(v.created_at) as created_at')))
                ->groupBy('v.created_at')
                ->orderBy('v.created_at')
                ->get();


        $vacancies->groupBy('v.created_at');

        return response()->json(['count_by_days'=>$vacancies]);
        
    }
}
