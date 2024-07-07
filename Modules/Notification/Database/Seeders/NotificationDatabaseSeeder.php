<?php

namespace Modules\Notification\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class NotificationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module = include(module_path('notification', 'Config/module.php'));

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

            if(config('app.demo')){
                $this->call(ScheduleSmsDatabaseSeeder::class);
                $this->call(ScheduleEmailDatabaseSeeder::class);
            }


        } catch (\Exception $exception) {

            Log::error('Notification Seed Failed!');
            Log::info(get_exception_message($exception));
            DB::rollBack();
        }

        DB::commit();
    }
}
