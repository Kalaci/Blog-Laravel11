<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'date_published', 
        'user_id', 
        'thumbnail', 
        'date_updated'
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}