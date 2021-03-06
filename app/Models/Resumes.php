<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resumes extends Model
{
    use HasFactory;

    public function student(){
        return $this->belongsTo('App\Models\Students');
    }

    public function specialties(){
        return $this->belongsToMany('App\Models\Specialties');
    }

    public function skills(){
        return $this->belongsToMany('App\Models\Skills');
    }
}
