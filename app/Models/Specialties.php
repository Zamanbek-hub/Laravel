<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialties extends Model
{
    use HasFactory;

    public function resumes(){
        return $this->belongsToMany('App\Models\Resumes');
    }

    public function vacancies(){
        return $this->belongsToMany('App\Models\Vacancies');
    }
}
