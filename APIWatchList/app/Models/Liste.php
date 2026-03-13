<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Liste extends Model
{
    protected $fillable = [
        "name"
    ];

    public function movies(){
        return $this->belongsToMany(Movie::class, 'liste_movie','liste_id','movie_id');
    }
}
