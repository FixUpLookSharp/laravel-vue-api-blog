<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExplanationBlockedUserRequest;
use App\Http\Requests\LockedUserRequest;
use App\Mail\ExplanationFromUserBlockedMail;
use App\Mail\UnblockUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

    public function explanationBlockedUser(ExplanationBlockedUserRequest $request)
    {
        $email = $request->input('email');
        $explanation = $request->input('explanation');
        $user = Auth::guard()->user();
        $date = Cache::get('user-explanation-' . $user->id);
        if (Cache::get('user-explanation-' . $user->id)) {
            return response()->json([
                'access' => false,
                'message' => 'Время повторной отправки, будет доступно ' . $date->format('d.m.y H:i'),
            ]);
        }

        $expiresAt = Carbon::now()->addHours(48);
        Cache::put('user-explanation-' . $user->id, $expiresAt, $expiresAt);

        $data =
            [
                'email' => $email,
                'explanation' => $explanation,
                'user' => $user,
            ];

        Mail::later(now()->addMinutes(1), new ExplanationFromUserBlockedMail($data));
        return response()->json($data);
    }

}
