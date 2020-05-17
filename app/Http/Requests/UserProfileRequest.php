<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'user_name' => 'required',
            'age' => 'required',
            'residence' => 'required',
            'job' => 'required',
            'text' => 'min:5,max:1000',
        ];
    }

    public function attributes()
    {
        return [
            'user_name' => 'ユーザ名',
            'age'       => '年齢',
            'residence' => '居住地',
            'job'       => '職業',
            'text'      => '自己紹介文',
        ];
    }
}
