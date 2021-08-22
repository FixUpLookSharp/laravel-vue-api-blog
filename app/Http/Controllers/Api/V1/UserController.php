<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword(UpdatePasswordRequest $request)
    {

        $user = Auth::guard()->user();

        $oldpassword = $request->input('current_password');
        $password = $request->input('new_password');

        if (!Hash::check($oldpassword, $user->password)) {
            return response()->json(['errors' => ['current_password' => ['Пароль не соответствует действующему']]], 422);
        }

        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();

        return response()->json(['status' => true, 'message' => 'Пароль успешно обновлен']);
    }

    public function changeUser(UserUpdateRequest $request)
    {
        $user = Auth::guard()->user();

        $name = $request->input('name');
        $email = $request->input('email');
        $nickname = $request->input('nickname');
        $address = $request->input('address');
        $info = $request->input('info');
        $vk = $request->input('vk');
        $instagram = $request->input('instagram');
        $facebook = $request->input('facebook');
        $phone = $request->input('phone');

        if ($request->file()) {
            $photo = $request->file('photo')->store('post', 'public');
        }

        $user->name = $name;
        $user->email = $email;
        $user->nickname = $nickname;
        $user->address = $address;
        $user->info = $info;
        $user->vk = $vk;
        $user->instagram = $instagram;
        $user->facebook = $facebook;
        $user->phone = $phone;


        if (isset($photo)) {
            $user->photo = $photo;
        }

        $user->save();

        return response()->json('true');
    }

    public function myPosts()
    {
        $user = Auth::guard()->user();
        $articles =  $user->articles->map(function ($article) {
                $res = [
                    'id' => $article->id,
                    'title' => $article->title,
                    'dir' => $article->dir,
                    'likes_count' => $article->likes_count,
                    'photo' => $article->photo,
                    'created_at' => $article->created_at,
                    'category_name'=> $article->category->name,
                    'creator' => [
                        'id' => $article->creator->id,
                        'photo' => $article->creator->photo,
                        'name' => $article->creator->name,
                    ],
                    'count_comments' => count($article->comments)
                ];
                return $res;
        });

        if (count($articles) == 0) return response()->json(false, 200);

        return response()->json($articles, 200);

    }
}
