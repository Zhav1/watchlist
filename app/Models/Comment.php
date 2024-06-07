<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $primaryKey = 'comment_id';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'movie_id',
        'user_id',
        'comment'
    ];

    protected $dates = [
        'tanggal',
    ];
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
