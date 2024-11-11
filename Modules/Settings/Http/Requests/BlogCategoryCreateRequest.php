<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;


class BlogCategoryCreateRequest extends RootRequest
{
    public function authorize()
    {
        return has_permission('componentSettings.blogCategory.add');
    }

    public function rules()
    {
        return [
             'title' => 'required',
             'name' => 'required',
             'details' => 'required',
             'status' => 'required',
        ];
    }


    public function message(bool $absolute = true)
    {
        return [];
    }


}
