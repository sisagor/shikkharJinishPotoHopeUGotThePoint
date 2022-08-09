<?php

namespace Modules\Employee\Http\Requests;

use App\Http\Requests\RootRequest;
use Illuminate\Support\Facades\DB;
use Modules\Employee\Entities\Employee;

class PersonalInfoUpdateRequest extends RootRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $employee = Employee::with('user')->where('id', $this->id)->first();

        if ($employee->user){
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'email' => 'required|email|unique:employees,email,'.$this->id.'|unique:users,email,'.$employee->user->id,
            ];
        }

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:employees,email,'.$this->id,
        ];

    }


    public function message(bool $absolute = true)
    {
        return [

        ];
    }


}
