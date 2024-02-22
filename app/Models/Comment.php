<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'comments';

    protected $fillable = [
        'content',
        'post_id',
        'viewer_id',
        'number_of_like'
    ];
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
