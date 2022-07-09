<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        // if($this->user_id == auth()->user()->id) {
        //     return true;
        // } else {
        //     return false;
        // }
        return true;
    }

    public function rules()
    {
        $post = $this->route()->parameter('post');

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'status' => 'required|in:0,1',
            'file' => 'image'
        ];

        if($post) {
            $rules['slug'] = 'required|unique:posts,slug,'.$post->id;
        }

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
