<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchGithubRequest extends FormRequest
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
            'usernames' => "required|max:10"
        ];
    }

    public function messages()
    {
        return [
            'usernames.required' => 'Should have at least one username to search',
            'usernames.max' => 'Searches should not exceed max of 10',
        ];
    }
}
