<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Blog;
use App\Models\BlogCategory;

class Keyword extends Model
{
    use HasFactory;
    protected $table = 'keywords';
    protected $fillable = ['id' => 'string', 'timestamps'];
    public $incrementing = false;

    public function Blog()
    {
        return $this->hasMany(Blog::class, 'id');
    }
    public function Category()
    {
        return $this->hasMany(BlogCategory::class, 'id');
    }
}
