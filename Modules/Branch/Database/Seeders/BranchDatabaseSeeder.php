<?php

namespace Modules\Branch\Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Model;


class BranchDatabaseSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module = include(module_path('branch', 'Config/module.php'));

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
                        'order' => $menu['order'],
                        'action' => $menu['action'],
                        'show' => $menu['show'],
                        'status' => $menu['status'],
                    ]);
                }
            }
            //End Module Menu Seed

            $branch = DB::table('branches')->insertGetId([
                'name' => "Demo Branch",
                'email' => "branch@demo.com",
                'phone' => "01826319556",
                'address' => "Dhaka, Bangladesh",
            ]);

            DB::table('users')->insert([
                'id' => 4,
                'branch_id' => $branch,
                'name' => "Demo Branch",
                'level' => User::USER_BRANCH_ADMIN,
                'email' => "branch@demo.com",
                'password' => Hash::make('123456'),
                'status' => 1,
            ]);

            DB::table('branch_settings')->insert([
                'branch_id' => $branch,
                'allow_employee_login' => 1,
            ]);

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
                            'imageable_id' => $branch,
                            'imageable_type' => 'Modules\Branch\Entities\Branch',
                            'created_at' => Carbon::Now(),
                            'updated_at' => Carbon::Now(),
                        ]
                    ]);
                }
            }


        } catch (\Exception $exception) {

            Log::error('Branch Seed Failed!');
            Log::info(get_exception_message($exception));
            DB::rollBack();
        }

        DB::commit();
    }
}
