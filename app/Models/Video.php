<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillabe = [
        'name',
        'path',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
