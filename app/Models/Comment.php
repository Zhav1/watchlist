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
        'comment'
    ]; 
	
    protected $dates = [
        'tanggal',
    ];
		public function film()
    {
        return $this->belongsTo(Movie::class);
    }
}
