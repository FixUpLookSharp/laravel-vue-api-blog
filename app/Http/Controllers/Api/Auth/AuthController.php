<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\UserRegistrationJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

    }//end __construct()


    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'    => 'required|email',
                'password' => 'required|string|min:8',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        if ($request->input('remember')) {
            $token_validity = (24 * 600000);
        } else {
            $token_validity = (24 * 60);
        }


        $this->guard()->factory()->setTTL($token_validity);

        if (!$token = $this->guard()->attempt($validator->validated())) {
            return response()->json(['error' => 'Неправильное имя пользователя или пароль'], 401);
        }

        return $this->respondWithToken($token);

    }//end login()


    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'     => 'required|string|between:2,100|unique:users',
                'email'    => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6',
            ]
        );
        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->photo = 'user/userStandart.jpg';
        $user->nickname = 'user-' . $this->generateNameHash($request->name);
        $user->role_id = 1;
        $user->save();

        $token_validity = (24 * 60);

        $this->guard()->factory()->setTTL($token_validity);

        $token = $this->guard()->attempt($validator->validated());

        dispatch(new UserRegistrationJob($user->email, $request->input('password')))->delay(now()->addMinutes(1));

        return response()->json(
            [
            'token'     => $this->respondWithToken($token),
            ], 200);

    }//end register()


    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Вы успешно вышли из системы'], 200);

    }//end logout()


    public function profile()
    {
        $this->IsUserOnline();
        return response()->json($this->guard()->user());

    }//end profile()


    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());

    }//end refresh()


    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'token'          => $token,
                'token_type'     => 'bearer',
                'token_validity' => ($this->guard()->factory()->getTTL() * 60),
            ]
        );

    }//end respondWithToken()


    protected function guard()
    {
        return Auth::guard();

    }//end guard()

    private function generateNameHash($name)
    {
        $new = md5($name);
        $arr = str_split($new);
        $result = '';
        for($i = 0; $i < 16; $i++) {
            $result .= $arr[$i];
        }
        return $result;
    }

    private function IsUserOnline()
    {
        if($this->guard()->check()){
            if (Cache::get('user-is-online-' . $this->guard()->user()->id) === true) {
                return;
            }

            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('user-is-online-' . $this->guard()->user()->id, true, $expiresAt);
            $this->guard()->user()->is_online = Carbon::now();
            $this->guard()->user()->save();
        }
    }


}// end class

