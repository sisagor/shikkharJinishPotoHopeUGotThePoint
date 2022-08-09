<?php

namespace Modules\Employee\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class EmployeeDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $module = include(module_path('employee', 'Config/module.php'));

        try {

            DB::beginTransaction();

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
                        'order' => $menu['order'],
                        'action' => $menu['action'],
                        'show' => $menu['show'],
                        'status' => $menu['status'],
                    ]);
                }
            }

            ##demo
            if (config('app.demo')) {
                $this->call(DemoEmployeeTypeDatabaseSeeder::class);
                $this->call(DemoEmployeeDatabaseSeeder::class);
            }

            DB::commit();

        } catch (\Exception $exception) {

            DB::rollBack();
            Log::error("Employee Module create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
