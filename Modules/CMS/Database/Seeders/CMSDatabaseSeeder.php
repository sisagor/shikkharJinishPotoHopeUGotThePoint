<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class CMSDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::beginTransaction();

        try {
            //get Modules Seed config/module file
            $module = include(module_path('CMS', 'Config/module.php'));

            //Insert all modules
            if (! DB::table('modules')->where('name', $module['name'])->count())
            {

                $moduleCreated = DB::table('modules')->insertGetId([
                    'name' => $module['name'],
                    'icon' => $module['icon'],
                    'scope' => $module['scope'],
                    'order' => $module['order'],
                    'url' => $module['url'],
                    'status' => $module['status'],
                ]);

                //Insert all subbmodules
                foreach ($module['submodules'] as $submodule)
                {
                    $submoduleCreated = DB::table('submodules')->insertGetId([
                        'module_id' => $moduleCreated,
                        'name' => $submodule['name'],
                        'scope' => $submodule['scope'],
                        'show' => $submodule['show'],
                        'order' => $submodule['order'],
                        'status' => $submodule['status'],
                    ]);

                    //Insert all menus
                    foreach ($submodule['menu'] as $menu)
                    {
                        DB::table('menu')->insertGetId([
                            'submodule_id' => $submoduleCreated,
                            'name' => $menu['name'],
                            'url' => $menu['url'],
                            'action' => $menu['action'],
                            'show' => $menu['show'],
                        ]);
                    }
                }
            }

             if(config('app.demo'))
             {
                 $this->call(DemoBlogCategoryDatabaseSeeder::class);
                 $this->call(DemoBlogDatabaseSeeder::class);
                 $this->call(DemoBlogDetailsDatabaseSeeder::class);
                 $this->call(DemoBooksDatabaseSeeder::class);
             }

        } catch (\Exception $exception)
        {

            Log::error('Module CMS Seed Failed!');
            Log::info(get_exception_message($exception));
            DB::rollBack();
        }

        DB::commit();
        // $this->call("OthersTableSeeder");
    }
}