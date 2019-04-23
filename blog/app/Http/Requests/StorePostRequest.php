<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|unique:posts,title|max:255',
            'content' => 'required',
            'postFile' => 'mimes:jpeg,bmp,png,jpg|max:1024',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => __('messages.titleRequired'),
            'content.required'  => __('messages.contentRequired'),
            'postFile.max'  => __('messages.postFileMax'),
            'postFile.mimes'  => __('messages.postFileMimes'),
        ];
    }
}
