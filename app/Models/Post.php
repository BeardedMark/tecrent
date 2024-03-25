<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'commentary',
        'description',
        'content',
        'image',
        'emoji',
        'autor',
        'release',
    ];

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
