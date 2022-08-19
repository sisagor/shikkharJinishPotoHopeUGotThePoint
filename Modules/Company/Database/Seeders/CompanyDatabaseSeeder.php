<?php

namespace Modules\Company\Database\Seeders;

use App\Models\RootModel;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Modules\Company\Entities\CompanySetting;

class CompanyDatabaseSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module = include(module_path('company', 'Config/module.php'));

        // $this->call("OthersTableSeeder");

        DB::beginTransaction();

        try {

            //Module Menu Seed
            $moduleCreated = DB::table('modules')->insertGetId([
                'name' => $module['name'],
                'icon' => $module['icon'],
                'url' => $module['url'],
                'status' => $module['status'],
                'scope' => $module['scope'],
                'order' => $module['order'],
            ]);

            //Insert all subbmodules
            foreach ($module['submodules'] as $submodule) {

                $submoduleCreated = DB::table('submodules')->insertGetId([
                    'module_id' => $moduleCreated,
                    'name' => $submodule['name'],
                    'scope' => $submodule['scope'],
                    'show' => $submodule['show'],
                    'order' => $submodule['order'],
                    'status' => $submodule['status'],
                ]);

                //Insert all menus
                foreach ($submodule['menu'] as $menu) {
                    DB::table('menu')->insertGetId([
                        'submodule_id' => $submoduleCreated,
                        'name' => $menu['name'],
                        'url' => $menu['url'],
                        'action' => $menu['action'],
                        'show' => $menu['show'],
                    ]);
                }
            }
            //End Module Menu Seed
            $company = DB::table('companies')->insertGetId([
                'name' => "Demo Company",
                'email' => "company@demo.com",
                'phone' => "01826319556",
                'details' => "This is testing master agent",
                'address' => "Dhaka, Bangladesh",
                'status' => RootModel::STATUS_ACTIVE,
            ]);

            DB::table('users')->insert([
                'id' => 3,
                'com_id' => $company,
                'name' => "Demo Company",
                'level' => User::USER_COMPANY_ADMIN,
                'email' => "company@demo.com",
                'password' => Hash::make('123456'),
                'status' => RootModel::STATUS_ACTIVE,
            ]);

            DB::table('company_settings')->insert([
                'com_id' => $company,
                'has_provision_period' => 0,
                'employee_id_prefix' => "DC",
                'allow_overtime' => 0,
                'attendance' => CompanySetting::ATTENDANCE_MANUAL,
                'has_attendance_deduction_policy' => 0,
                'allow_employee_login' => 1,
            ]);

            DB::table('branches')->where('id', 1)->update(['com_id' => $company]);
            DB::table('branch_settings')->where('id', 1)->update(['com_id' => $company]);


            if (File::isDirectory($this->demo_dir)) {
                $img = $this->demo_dir . "/user.jpg";
                // if (! file_exists($img)) continue;
                $name = "user.jpg";
                $targetFile = $this->dir . DIRECTORY_SEPARATOR . $name;

                if ($this->disk->put($targetFile, file_get_contents($img))) {
                    DB::table('images')->insert([
                        [
                            'name' => $name,
                            'path' => $targetFile,
                            'extension' => 'jpg',
                            'type' => 'profile',
                            'imageable_id' => $company,
                            'imageable_type' => 'Modules\Company\Entities\Company',
                            'created_at' => Carbon::Now(),
                            'updated_at' => Carbon::Now(),
                        ]
                    ]);
                }
            }

        } catch (\Exception $exception) {

            Log::error('Company Seed Failed!');
            Log::info(get_exception_message($exception));
            DB::rollBack();
        }

        DB::commit();

    }
}
