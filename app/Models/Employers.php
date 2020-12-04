<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employers extends Model
{
    use HasFactory;

    protected $guarded = [];  

    public function resumes(){
        return $this->hasMany('App\Models\Vacancies');
    }
}
