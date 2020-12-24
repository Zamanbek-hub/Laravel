<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employers extends Model
{
    use HasFactory;

    protected $guarded = [];  

    public function vacancies(){
        return $this->belongsToMany('App\Models\Vacancies');
    }

    public function region(){
        return $this->belongsTo('App\Models\Regions');
    }

    public function user(){
        return $this->hasOne('App\Models\User');
    }
}
