<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Blog;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    public function User()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function Blog()
    {
        return $this->belongsTo(Blog::class, 'id');
    }
}
