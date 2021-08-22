<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LockedUserControllerPolicy
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

    public function userBlock(User $auth, $user)
    {
        if ($user->role_id === 3) return Response::deny('Блокировка администраторов запрещена!');
        if ($auth->role_id === 3 && $user->role_id !== 3) {
            return true;
        }

        return Response::deny('Блокировку может произвести только Администратор!');
    }
    public function userUnblock(User $auth, $user)
    {
        if ($user->role_id === 3) return Response::deny('Разблокировка администраторов запрещена!');
        if ($auth->role_id === 3 && $user->role_id !== 3) {
            return true;
        }

        return Response::deny('Нет прав на разблокировку!');
    }

}
