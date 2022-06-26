<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BlogCategory;
use App\Models\Keyword;
use App\Models\Comment;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    public function Category()
    {
        return $this->belongsTo(BlogCategory::class, 'id');
    }
    public function Keyword()
    {
        return $this->belongsTo(Keyword::class, 'id');
    }
    public function Comments()
    {
        return $this->hasMany(Comment::class, 'id');
    }
}
