<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails, ResetsPasswords {
        SendsPasswordResetEmails::broker insteadof ResetsPasswords;
        ResetsPasswords::credentials insteadof SendsPasswordResetEmails;
    }

    public function sendPasswordResetLink(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'status' => true,
            'message' => 'Письмо для сброса пароля отправлено.',
        ]);
    }


    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json([
            'status' => false,
            'message' => 'Электронный адрес введен не корректно или не существует!'
        ]);
    }

    public function callResetPassword(Request $request)
    {
        return $this->reset($request);
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}/',
        ];
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['status' => true, 'message' => 'Пароль успешно сброшен.']);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['status' => false, 'message' => 'Ошибка, недопустимый токен.']);
    }

}
