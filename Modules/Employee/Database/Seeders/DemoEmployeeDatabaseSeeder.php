<?php

namespace Modules\Employee\Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class DemoEmployeeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        try {

            DB::beginTransaction();

            for ($i = 0; $i < 10; $i++) {
                $id = sprintf('%04d', $i + 5);

                $email = "employee" . $i . '@demo.com';

                $employee = DB::table('employees')->insertGetId([
                    'com_id' => 1,
                    'branch_id' => ($i > 4) ? 1 : null,
                    'employee_index' => 'DC' . $id,
                    'name' => "Employee $id",
                    'first_name' => "Employee",
                    'last_name' => $i,
                    'email' => $email,
                    'phone' => "+8801826319556",

                    'fathers_name' => "Father $id",
                    'mothers_name' => "Mother $id",
                    'present_address' => "Present Addrrss $id",
                    'parmanent_address' => "Parmanent Address $id",
                    'religion' => "Muslim",
                    'prl_date' => Carbon::now(),
                    // 'status' => "Status $id",
                    'posted_as' => "Posted As $id",
                    'joining_back_verified' => "Joining back $id",
                    'hris_id' => "637462783 $id",
                    'post_id' => "4632546 $id",
                    'bcs_batch_no' => $i + 20,
                    'code_no' => $i + 1,
                    'study_deputation_number' => $i + 2,
                    'original_designation' => "Designation $id",
                    'nid' => $id,
                    'acr_availability' => "Available $id",
                    'educational_qualification' => "Qualification",
                    'actual_degree' => "Degree",
                    'educational_discipline' => "Discipline",

                    // Other information
                    'tribe' => true,
                    'freedom_fighter' => false,
                    'lives_in_govt_quarter' => true,
                    'professional_discipline' => "Unknown",
                    'health_service_joining_date' => Carbon::now(),
                    'current_place_joining_date' => Carbon::now(),
                    'current_designation_joining_date' => Carbon::now(),
                    'current_pay_scale_hold' => "Unknown",
                    'current_basic_pay' => "Unknown",

                    // Additonal Information
                    'last_promotion_information' => "Unknown",
                    'training_information' => "Unknown",
                    'first_appointment_information' => "Unknown",
                    'bcs_psc_information' => "Unknown",
                    'service_confirmation_information' => "Unknown",
                    'senior_scale_pass' => false,
                    'experience_in_village' => false,

                    'department_id' => ($i > 4) ? 2 : 1,
                    'designation_id' => ($i > 4) ? 1 : 2,
                    'shift_id' => 1,
                    'provision_period' => ($i % 2 == 0) ? 1 : 0,
                    //'overtime' => $request->get('overtime'),
                    'type_id' => ($i % 2 == 0) ? 1 : 2,
                    'status' => 1,
                    'created_at' => Carbon::now(),
                ]);

                DB::table('users')->insert([
                    'com_id' => 1,
                    'branch_id' => ($i > 4) ? 1 : null,
                    'name' => "Employee" . ' ' . $i,
                    'email' => $email,
                    'level' => User::USER_EMPLOYEE,
                    'employee_id' => $employee,
                    'password' => Hash::make(123456),
                    'status' => 1,
                    'created_at' => Carbon::now(),
                ]);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            //dd($exception);
            Log::error("Employee Demo create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
