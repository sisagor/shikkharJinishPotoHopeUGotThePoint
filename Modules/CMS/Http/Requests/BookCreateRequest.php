<?php

namespace Modules\CMS\Http\Requests;

use App\Http\Requests\RootRequest;


class BookCreateRequest extends RootRequest
{
    public function authorize()
    {
        return has_permission('cms.book.add');
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'url' => 'required',
            'status' => 'required',
            'url_type' => 'nullable',
            'order' => 'required',
            'image' => 'required',
        ];
    }


    public function message(bool $absolute = true)
    {
        return [];
    }


}
