<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'author_id');
    }

    public function recepient()
    {
        return $this->belongsTo(__NAMESPACE__ . '\User', 'recepient_id');
    }

    public function chat()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Chat', 'chat_id');
    }
}
