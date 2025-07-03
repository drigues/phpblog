<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Allow these fields to be mass assigned:
    protected $fillable = [
        'title',
        'body',
        'published_at',
    ];
    
    protected $casts = [
        'published_at' => 'datetime',
    ];
}
