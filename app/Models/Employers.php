<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employers extends Model
{
    use HasFactory;

    public function vacancies(){
        return $this->hasMany('App\Models\Vacancies');
    }

    public function region(){
        return $this->belongsTo('App\Models\Regions');
    }
}
