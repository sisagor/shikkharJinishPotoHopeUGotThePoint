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
            'name' => 'required|unique:blog_categories,com_id,' . com_id(),
            'details' => 'required',
            'status' => 'required',
        ];

    }


    public function message(bool $absolute = true)
    {
        return [

        ];
    }


}
