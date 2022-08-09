<?php

namespace Modules\User\Repositories;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\EloquentRepository;


class RoleRepository extends EloquentRepository implements RoleRepositoryInterface
{
    public $model;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function all()
    {
        //Cache::forget('roles_' . Auth::id());
        return $this->model->mine()->select(Role::$fetch);
    }

    public function store($request): bool
    {
        DB::beginTransaction();

        try {

            $role = $this->model->create([
                'name' => $request->get('name'),
                'level' => $request->get('level'),
                'details' => $request->get('details'),
                'status' => $request->get('status'),
            ]);

            foreach ($request->get('actions') as $action) {

                $exp1 = explode('_', $action);
                $exp2 = explode('|', $exp1[0]);

                Permission::create([
                    'role_id' => $role->id,
                    'module_id' => $exp2[0] ?? null,
                    'submodule_id' => $exp2[1] ?? null,
                    'menu_id' => $exp2[2] ?? null,
                    'action' => $this->getAction($exp1[1]),
                ]);
            }

        } catch (\Exception $exception) {

            Log::error('Role create failed');
            Log::info($exception->getMessage());
            DB::rollBack();

            return false;
        }
        DB::commit();

        return true;

    }


    public function update($request, $model): bool
    {
        DB::beginTransaction();

        try {

            $role = $this->model->find($model);

            $role->update([
                'name' => $request->get('name'),
                'level' => $request->get('level'),
                'details' => $request->get('details'),
                'status' => $request->get('status'),
            ]);

            Permission::where('role_id', $role->id)->delete();

            foreach ($request->get('actions') as $action) {

                $exp1 = explode('_', $action);
                $exp2 = explode('|', $exp1[0]);

                Permission::create([
                    'role_id' => $role->id,
                    'module_id' => $exp2[0] ?? null,
                    'submodule_id' => $exp2[1] ?? null,
                    'menu_id' => $exp2[2] ?? null,
                    'action' => $this->getAction($exp1[1]),
                ]);
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Role update failed');
            Log::info($exception->getMessage());

            return false;
        }
        DB::commit();

        return true;

    }


    /*Delete Role*/
    public function destroy($model): bool
    {
        DB::beginTransaction();

        try {
            $role = $this->find($model);
            Permission::where('role_id', $model)->delete();
            $role->forceDelete();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Role Delete failed');
            Log::info($exception->getMessage());

            return false;
        }
        DB::commit();

        return true;

    }


    protected function getAction($action) : string
    {
        $action = explode('|', $action);

        if (Str::contains($action[0], ' ')){
            $exp = explode(' ', $action[0]);
            return (strtolower($exp[0]).ucfirst($exp[1]).".".$action[1]);
        }
        return  (strtolower($action[0]).".".$action[1]);
    }


}
