<?php

namespace Modules\User\Database\Seeders;

use App\Models\Role;
use App\Models\RootModel;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $adminModules = admin_modules();
        $companyModules = company_modules();
        $branchModules = branch_modules();
        $employeeModules = employee_modules();

        DB::beginTransaction();

        try {

            /*Start Admin*/
            $adminRole = DB::table('roles')->insertGetId([
                'id' => 1,
                'name' => 'Admin',
                'level' => Role::ROLE_ADMIN_USER,
                'details' => 'Admin role',
                'status' => RootModel::STATUS_ACTIVE,
            ]);

            foreach ($adminModules as $module) {

                foreach ($module->submodules as $submodule) {

                    foreach ($submodule->menu as $menu) {

                        DB::table('role_permissions')->insert([
                            'role_id' => $adminRole,
                            'module_id' => $module->id ?? null,
                            'submodule_id' => $submodule->id ?? null,
                            'menu_id' => $menu->id ?? null,
                        ]);
                    }
                }

            }
            /*End Admin*/

            /*Start Company*/
            $companyRole = DB::table('roles')->insertGetId([
                'id' => 2,
                'name' => 'Company Role',
                'level' => Role::ROLE_COMPANY,
                'details' => 'Company Role',
                'status' => RootModel::STATUS_ACTIVE,
            ]);

            //update company user role id
            DB::table('companies')
                ->join('users', 'companies.id', 'users.com_id')
                ->where('companies.id', 1)
                ->where('users.branch_id', null)
                ->update(['users.role_id' => $companyRole]);


            foreach ($companyModules as $module) {

                foreach ($module->submodules as $submodule) {

                    foreach ($submodule->menu as $menu) {

                        DB::table('role_permissions')->insert([
                            'role_id' => $companyRole,
                            'module_id' => $module->id ?? null,
                            'submodule_id' => $submodule->id ?? null,
                            'menu_id' => $menu->id ?? null,
                        ]);
                    }
                }

            }
            /*End Company*/

            /*Start Branch*/
            $branchRole = DB::table('roles')->insertGetId([
                'id' => 3,
                'com_id' => 1,
                'name' => 'Branch Role',
                'level' => Role::ROLE_BRANCH,
                'details' => 'Branch Role',
                'status' => RootModel::STATUS_ACTIVE,
            ]);

            //Update Branch Role Id;
            DB::table('users')
                ->where('branch_id', 1)
                ->update(['role_id' => $branchRole]);


            foreach ($branchModules as $module) {

                foreach ($module->submodules as $submodule) {

                    foreach ($submodule->menu as $menu) {

                        DB::table('role_permissions')->insert([
                            'role_id' => $branchRole,
                            'module_id' => $module->id ?? null,
                            'submodule_id' => $submodule->id ?? null,
                            'menu_id' => $menu->id ?? null,
                        ]);
                    }
                }

            }
            /*End Branch*/

            /*Start emloyee Role*/
            $employeeRole = DB::table('roles')->insertGetId([
                'id' => 4,
                'com_id' => 1,
                'name' => 'Employee Role',
                'level' => Role::ROLE_EMPLOYEE,
                'details' => 'Employee Role',
                'status' => RootModel::STATUS_ACTIVE,
            ]);

            //Update Branch Role Id;
            DB::table('users')
                ->where('employee_id', '!=', null)
                ->update(['role_id' => $employeeRole]);


            foreach ($employeeModules as $module) {

                foreach ($module->submodules as $submodule) {



                    foreach ($submodule->menu as $menu) {

                        DB::table('role_permissions')->insert([
                            'role_id' => $employeeRole,
                            'module_id' => $module->id ?? null,
                            'submodule_id' => $submodule->id ?? null,
                            'menu_id' => $menu->id ?? null,
                        ]);
                    }
                }

            }
            /*End employee*/

        } catch (\Exception $exception) {

            Log::error('Role Seed Failed!');
            Log::info(get_exception_message($exception));
            DB::rollBack();
        }

        DB::commit();

    }


    protected function getAction($subModuleName, $menuAction) : string
    {
        if (Str::contains($subModuleName, ' ')){
            $exp = explode(' ', $subModuleName);
            return (strtolower($exp[0]).ucfirst($exp[1]).".".$menuAction);
        }
        return  (strtolower($subModuleName).".".$menuAction);
    }


}
