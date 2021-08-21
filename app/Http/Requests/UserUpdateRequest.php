<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50|unique:users,name,' . Auth::user()->id,
            'email' => 'required|max:100|unique:users,email,' . Auth::user()->id,
            'nickname' => 'required|max:50|unique:users,nickname,' . Auth::user()->id,
            'photo' => 'image',
            'info' => 'max:100',
            'address' => 'max:50',
            'phone' => 'max:16',
            'vk' => 'max:255',
            'facebook' => 'max:255',
            'instagram' => 'max:255'
        ];
    }
}
