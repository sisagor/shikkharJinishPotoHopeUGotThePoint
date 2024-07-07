<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;


class SettingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module = include(module_path('settings', 'Config/module.php'));

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
                    'show' => $submodule['show'],
                    'scope' => $submodule['scope'],
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

            ##demo
            if (config('app.demo')) {
                $this->call(DemoLeaveTypeDatabaseSeeder::class);
                $this->call(DemoTaxDatabaseSeeder::class);
                $this->call(DemoHolidaysDatabaseSeeder::class);
                $this->call(DemoWorkingShiftDatabaseSeeder::class);
            }

            DB::commit();

        } catch (\Exception $exception) {

            DB::rollBack();
            Log::error("settings create Error!");
            Log::info(get_exception_message($exception));
        }
    }
}
