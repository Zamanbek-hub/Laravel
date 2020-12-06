<?php

namespace App\Http\Controllers;

use App\Models\Resumes;
use App\Models\FavoriteResumes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\PayUService\Exception;

class FavoriteResumeController extends Controller
{
    //
     /// Favorite Resume Ajax
   public function saveFavoriteResume()
   {    


        
    try{
        $user = Auth::user();
        $resume = Resumes::where('id', request('resume_id'))->first();
        if(isset($resume->id)){
            $favorite_resume=FavoriteResumes::where('user_id', $user->id)->where('resume_id', $resume->id)->first();
            error_log("resume =".$resume);
            error_log("favorite_resume =".$favorite_resume);
            if(! isset($favorite_resume->id)){
                error_log("first");
                $favorite_resume = new FavoriteResumes();
                error_log("second");
                error_log("user_id =".Auth::user()->id);
                $favorite_resume->user_id=$user->id;
                error_log("third");
                $favorite_resume->resume_id=request('resume_id');
                error_log("fourth");
                $favorite_resume->save();
                error_log("fivth");
                return response()->json(['success'=>'Resume Added to Favorites.']);
            }
            else{
                $favorite_resume->delete();
                return response()->json(['success'=>'Resume Removed from Favorites.']);
            }
            
        }
        error_log("error =");
       return response()->json(['error'=>'Not Found']);
    } catch(\Exception $e){
        error_log($e);
        return response()->json(['error'=>'Some error']);
    }
   }
}
