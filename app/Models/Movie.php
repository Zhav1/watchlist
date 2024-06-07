<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
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

}
