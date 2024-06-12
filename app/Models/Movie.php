<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
            'imdbID',
            'title',
            'plot',
            'poster',
            'genre',
            'year',
            'runtime',
            'director',
            'writer',
            'country',
            'language',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'watchlists', 'movie_id', 'user_id');
    }

}
