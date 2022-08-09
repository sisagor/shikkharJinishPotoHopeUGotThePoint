<?php

namespace Modules\Employee\Entities;

use App\Models\User;
use App\Models\RootModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeImporter extends RootModel  implements  ToModel, WithHeadingRow
{

    public function model(array $row)
    {

        try {

            DB::beginTransaction();

            $check = Employee::where('email', $row['email'])->count();

            if (! $check) {

                $create = Employee::create([
                    'employee_index' => $row['employee_index'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'joining_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['joining_date'])->format('Y-m-d'),
                ]);

                if ($row['password']) {
                    User::create([
                        'role_id' => null,
                        'employee_id' => $create->id,
                        'name' => $row['first_name'] . ' ' . $row['last_name'],
                        'email' => $row['email'],
                        'level' => User::USER_EMPLOYEE,
                        'password' => bcrypt($row['password']),
                    ]);
                }
            }else{

                \session()->flash('warning', $row['email']. ' employee already exist!');
            }

            DB::commit();

        }
        catch (\Exception $exception){

            DB::rollBack();
            Log::error("import error");
            Log::info(get_exception_message($exception));
        }


    }


}
