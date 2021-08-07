<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
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
        $bigLetters = ['Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Z','X','C','V','B','N','M',];
        $smallLetters = ['q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m',];
        $symbols = ['!','@','#','$','%','^','&','*',',','.','/','?',];
        $numbers = ['0','1','2','3','4','5','6','7','8','9',];

        $bigLettersBool = false;
        $smallLettersBool = false;
        $symbolsBool = false;
        $numbersBool = false;

        $user = Auth::guard()->user();

        $oldpassword = $request->input('old_password');
        $password = $request->input('password');

        $errors = [];

        for($i = 0; $i < strlen($password); $i++) {
            if(in_array($password[$i], $bigLetters) && !$bigLettersBool) {
                $bigLettersBool = true;
            }
            if(in_array($password[$i], $smallLetters) && !$smallLettersBool) {
                $smallLettersBool = true;
            }
            if(in_array($password[$i], $symbols) && !$symbolsBool) {
                $symbolsBool = true;
            }
            if(in_array($password[$i], $numbers) && !$numbersBool) {
                $numbersBool = true;
            }
        }

        if (!$bigLettersBool) {
            $errors['errors']['bigLatters'] = 'В пароле отсутствуют большие буквы!';
        }
        if (!$smallLettersBool) {
            $errors['errors']['smallLetters'] = 'В пароле отсутствуют маленькие буквы!';
        }
        if (!$symbolsBool) {
            $errors['errors']['symbols'] = 'В пароле отсутствуют символы!';
        }
        if (!$numbersBool) {
            $errors['errors']['numbers'] = 'В пароле отсутствуют числа!';
        }


        if (!Hash::check($oldpassword, $user->password)) {
            return response()->json(['errors' => ['password' => ['Пароль не соответствует действующему']]], 422);
        }
        if (Hash::check($password, $user->password)) {
            return response()->json(['errors' => ['password' => ['Пароль не может быть как действующий']]], 422);
        }

        if (!$bigLettersBool || !$smallLettersBool || !$symbolsBool) {
            return response()->json($errors, 422);

        }

        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();

        return response()->json(['status' => true, 'message' => 'Пароль успешно обновлен']);
    }
}
