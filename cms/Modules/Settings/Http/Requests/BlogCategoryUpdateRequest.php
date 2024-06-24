<?php

namespace Modules\Settings\Http\Requests;

use App\Http\Requests\RootRequest;

class BlogCategoryUpdateRequest  extends RootRequest
{
    public function authorize()
    {
        return has_permission('componentSettings.blogCategory.edit');
    }

    public function rules()
    {
        return [
            'details' => 'required',
            'status' => 'required',
            'name' => 'required|unique:blog_categories,name,' . $this->blogCategory->id,
        ];
    }


    public function message(bool $absolute = true)
    {
        /*return [];*/
    }


}
