<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancies extends Model
{
    use HasFactory;

    public function employer(){
        return $this->belongsTo('App\Models\Employers');
    }

    public function specialties(){
        return $this->belongsToMany('App\Models\Specialties');
    }

    public function skills(){
        return $this->belongsToMany('App\Models\Skills');
    }
}
