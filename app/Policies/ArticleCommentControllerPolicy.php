<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ArticleCommentControllerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user)
    {
        return $user->role_id === 3 ? true : Response::deny('Коментарий может удалить только создатель!');
    }
    public function update(User $auth, $comment)
    {
        return $auth->id === $comment->creator_id ? true : Response::deny('Коментарий может обновить только создатель!');
    }
    public function delete(User $auth, $comment)
    {
        return $auth->id === $comment->creator_id ? true : Response::deny('Коментарий может удалить только создатель!');
    }
}
