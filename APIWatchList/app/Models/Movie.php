<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title',
        'description',
        'release_year',
        'genre',
        'rating',
        'director',
        'duration'];
    public function liste(){
        return $this->belongsToMany(Liste::class , 'liste_movie', 'movie_id', 'liste_id');
    }
}
