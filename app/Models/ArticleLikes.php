<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleLikes extends Model
{
    use HasFactory;

    public function creator()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Article', 'article_id');
    }
}
