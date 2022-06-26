<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        if($this->user_id == auth()->user()->id) {
            return true;
        } else {
            return false;
        }
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:0,1',
            'file' => 'image'
        ];

        if($this->status == config('constants.STATUS_POST.PUBLISHED')) {
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required',
            ]);
        }

        return $rules;
    }
}
