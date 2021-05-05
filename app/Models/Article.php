<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'short_description', 'description', 'photo', 'path'];

    public function creator()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'creator_id');
    }

    public function category()
    {
        return $this->belongsTo(__NAMESPACE__ . '\ArticleCategory', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(__NAMESPACE__ . '\ArticleComment', 'article_id');
    }

    public function likes()
    {
        return $this->hasMany(__NAMESPACE__ . '\ArticleLikes', 'article_id');
    }
}
