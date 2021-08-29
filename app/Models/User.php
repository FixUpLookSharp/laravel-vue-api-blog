<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_online' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */

    public function articles()
    {
        return $this->hasMany(__NAMESPACE__ . '\Article', 'creator_id');
    }

    public function comments()
    {
        return $this->hasMany(__NAMESPACE__ . '\ArticleComment', 'creator_id');
    }

    public function articleLikes()
    {
        return $this->hasMany(__NAMESPACE__ . '\ArticleLike', 'creator_id');
    }

    public function author_messages()
    {
        return $this->hasMany(__NAMESPACE__ . '\Message', 'author_id');
    }

    public function recepient_messages()
    {
        return $this->hasMany(__NAMESPACE__ . '\Message', 'recepient_id');
    }

    public function subscriber1_chats()
    {
        return $this->hasMany(__NAMESPACE__ . '\Chat', 'subscriber1_id');
    }

    public function subscriber2_chats()
    {
        return $this->hasMany(__NAMESPACE__ . '\Chat', 'subscriber2_id');
    }

    public function role()
    {
        return $this->belongsTo(__NAMESPACE__ . '\Role', 'role_id');
    }

    public function isOnline()
    {
       return Cache::has('user-is-online-' . $this->id);
    }


    public function count_message($chat_id)
    {
        return $this->author_messages->where('chat_id', $chat_id)->count();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
