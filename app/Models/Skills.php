<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    public function vacancies(){
        return $this->belongsToMany('App\Models\Vacancies');
    }

    public function resumes(){
        return $this->belongsToMany('App\Models\Resumes');
    }
}
