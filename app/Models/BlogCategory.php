<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Blog;
use App\Models\Keyword;

class BlogCategory extends Model
{
    use HasFactory;
    protected $table = 'blogcategories';
    protected $fillable = ['id', 'keyword1', 'keyword2', 'keyword3', 'keyword4', 'keyword5'];
    public $incrementing = false;
    public function Blogs()
    {
        return $this->hasMany(Blog::class, 'id');
    }
    public function Keyword()
    {
        return $this->belongsTo(Keyword::class, 'id');
    }
}
