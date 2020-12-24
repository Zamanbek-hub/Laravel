<?php

namespace App\Http\Controllers;



use App\Models\Vacancies;
use App\Models\FavoriteVacancies;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteVacanciesController extends Controller
{
    //

    public function saveFavoriteVacancy()
    {    
     try{
        error_log("vacancy_id =".request('vacancy_id'));
         $user = Auth::user();
         $vacancy = Vacancies::where('id', request('vacancy_id'))->first();
         if(isset($vacancy->id)){
             $favorite_vacancy=FavoriteVacancies::where('user_id', $user->id)->where('vacancy_id', $vacancy->id)->first();
             error_log("resume =".$vacancy);
             error_log("favorite_resume =".$favorite_vacancy);
             if(! isset($favorite_vacancy->id)){
                 error_log("first");
                 $favorite_vacancy = new FavoriteVacancies();
                 error_log("second");
                 error_log("user_id =".Auth::user()->id);
                 $favorite_vacancy->user_id=$user->id;
                 error_log("third");
                 $favorite_vacancy->vacancy_id=request('vacancy_id');
                 error_log("fourth");
                 $favorite_vacancy->save();
                 error_log("fivth");
                 return response()->json(['success'=>'Vacancy Added to Favorites.']);
             }
             else{
                 $favorite_vacancy->delete();
                 return response()->json(['success'=>'Vacancy Removed from Favorites.']);
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
