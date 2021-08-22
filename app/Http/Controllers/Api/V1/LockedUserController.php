<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LockedUserRequest;
use App\Mail\UnblockUser;
use App\Models\User;
use http\Env\Response;
use Illuminate\Support\Facades\Mail;
class LockedUserController extends Controller
{
    public function block(User $user, LockedUserRequest $request)
    {

        $this->authorize('user-block', [self::class, $user]);

        $cause = $request->input('cause');

        $user->is_banned = 1;
        $user->cause = $cause;
        $user->save();

        return response()->json('Пользователь заблокирован', 200);
    }

    public function unblock(User $user)
    {
        $this->authorize('user-unblock', [self::class, $user]);


//        if (\Auth::guard()->user()->role_id  == 2 || \Auth::guard()->user()->role_id  == 1) {
//            return response()->json('Нет прав на разблокировку');
//        }

        $user->is_banned = 0;
        $user->cause = null;
        $user->save();
        $data = [
            'email' => $user->email,
            'text' => 'Вы разблокированы, при повторном нарушении вы будете заблокированы навсегда!'
        ];

        Mail::later(now()->addMinutes(1), new UnblockUser($data));

        return response()->json('Пользователь разблокирован', 200);

    }
}
