<?php

namespace Modules\CMS\Http\Requests;

use App\Http\Requests\RootRequest;


class BlogUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return ! is_employee();
    }

    public function rules()
    {

        if ($this->title){
            $required = ['status' => 'required'];
        }
        else{
            $required = [];
        }

        return array_merge([
            'category_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'status' => 'required|integer',
            'orders' => 'required|array',
            'orders.*' => 'nullable|integer',
            'details' => 'required|array',
            'details.*' => 'nullable|string',
            'images' => 'array',
            'images.*' => 'file|mimes:jpeg,jpg,png|max:2048',

        ], $required);
    }


    public function message()
    {
        return [];
    }


}
