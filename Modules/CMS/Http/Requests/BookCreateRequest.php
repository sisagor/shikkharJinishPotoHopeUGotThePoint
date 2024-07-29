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
            'url' => 'required',
            'status' => 'required',
            'order' => 'required',
            'image' => 'required',
        ];
    }


    public function message(bool $absolute = true)
    {
        return [];
    }


}
