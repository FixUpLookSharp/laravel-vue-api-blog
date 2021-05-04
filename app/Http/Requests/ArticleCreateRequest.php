<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCreateRequest extends FormRequest
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
            'title' => 'required|min:4|max:50|unique:articles',
            'category_id' => 'required|exists:article_categories,id',
            'short_description' => 'required|min:3|max:80',
            'description' => 'required|min:10',
            'photo' => 'mimes:jpeg,bmp,png,jpg'
        ];
    }
}
