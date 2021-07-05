<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function info(User $user)
    {
        $newUser = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo,
            'isOnlineBool' => $user->isOnline(),
            'isOnline' => $user->is_online,
            'phone' => $user->phone,
            'created_at' => $user->created_at,
            'count_comments' => count($user->comments),
            'nickname' => $user->nickname,
            'facebook' => $user->facebook,
            'instagram' => $user->instagram,
            'vk' => $user->vk,
            'info' => $user->info,
            'address' => $user->address,
            'is_banned' => $user->is_banned,
            'role' => $user->role,
            'count_articles' => count($user->articles),

        ];
        return response()->json($newUser, 200);
    }

    public function allUsers(Request $request)
    {

        $users = User::all()->map(function ($user) {
            $yearUser = $user->created_at->toObject()->year;
            $monthUser = $user->created_at->toObject()->month;
            $dayUser = $user->created_at->toObject()->day;


            $dateUser = Carbon::createMidnightDate($yearUser, $monthUser, $dayUser);
            $dateToDay = Carbon::now();

           $res = [
               'id' => $user->id,
               'name' => $user->name,
               'nickname' => $user->nickname,
               'email' => $user->email,
               'created_at' =>  $dateUser->diffInDays($dateToDay),
               'is_banned' => $user->is_banned,
               'status' => $user->role->name,
           ];

           return $res;
        });

        $page = $request->input('page');
        return response()->json(MyHelper::getPaginator($users, 2, $page));
    }

    public function userSearch(Request $request)
    {
        $saerchName = $request->input('search');

        $users = User::query()
            ->where('name', 'like', $saerchName . '%')
            ->where('id', '!=', Auth::guard()->user()->id)
            ->get();

       $users = $users->map(function ($user) {
            $yearUser = $user->created_at->toObject()->year;
            $monthUser = $user->created_at->toObject()->month;
            $dayUser = $user->created_at->toObject()->day;

            $date1 = Carbon::createMidnightDate(2020, 3, 15);
            $date2 = Carbon::createMidnightDate($yearUser, $monthUser, $dayUser);

            $res = [
                'id' => $user->id,
                'name' => $user->name,
                'nickname' => $user->nickname,
                'email' => $user->email,
                'created_at' =>  $date1->diffInDays($date2),
                'is_banned' => $user->is_banned,
                'status' => $user->role->name,
            ];

            return $res;
        });



        return response()->json($users, 200);
    }
}
