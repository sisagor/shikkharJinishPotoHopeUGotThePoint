<?php

namespace Modules\Employee\Repositories;

use App\Models\User;
use App\Models\Address;
use App\Models\RootModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\EloquentRepository;
use Modules\Employee\Entities\Employee;
use Modules\Employee\Entities\EmployeeEducation;


class EmployeeRepository extends EloquentRepository implements EmployeeRepositoryInterface
{
    public $model;

    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    //Get all Employee
    public function all()
    {
        $data = Employee::mine()->active()
            ->with('department:id,name')
            ->with('designation:id,name')
            ->with('employeeType:id,name')
            ->select('id', 'status', 'department_id', 'designation_id', 'type_id', 'employee_index', 'first_name', 'last_name', 'email', 'phone', 'device_id')
            ->where('status', RootModel::STATUS_ACTIVE);

        //department filter and scope:
        $data = (\request()->filled('department_id') ? $data->where('department_id', \request()->get('department_id'))
                :(Auth::user()->department_id ? $data->where('department_id', Auth::user()->department_id) : $data));

        //Designation  filter;
        return  (\request()->filled('designation_id') ? $data->where('designation_id', \request()->get('designation_id')): $data);
    }

    //Get all trash
    public function trashOnly()
    {
        $data = Employee::mine()->active()->onlyTrashed()
            ->with('department:id,name')
            ->with('designation:id,name')
            ->with('employeeType:id,name')
            ->select('id', 'status', 'department_id', 'designation_id', 'type_id', 'employee_index', 'first_name', 'last_name', 'email', 'phone', 'device_id');

        //department filter and scope:
        $data = (\request()->filled('department_id') ? $data->where('department_id', \request()->get('department_id'))
                :(Auth::user()->department_id ? $data->where('department_id', Auth::user()->department_id) : $data));

        //Designation  filter;
        return  (\request()->filled('designation_id') ? $data->where('designation_id', \request()->get('designation_id')): $data);
    }

    //Get all inactive employee
    public function inactive(Request $request)
    {
        $data = Employee::mine()->inactive()
            ->with('department:id,name')
            ->with('designation:id,name')
            ->with('employeeType:id,name')
            ->select('id', 'status', 'department_id', 'designation_id', 'type_id', 'employee_index', 'first_name', 'last_name', 'email', 'phone', 'device_id')
            ->where('status', RootModel::STATUS_INACTIVE);

        //department filter and scope:
        $data = (\request()->filled('department_id') ? $data->where('department_id', \request()->get('department_id'))
            :(Auth::user()->department_id ? $data->where('department_id', Auth::user()->department_id) : $data));

        //Designation  filter;
        return (\request()->filled('designation_id') ? $data->where('designation_id', \request()->get('designation_id')): $data);
    }

    //Get all inactive employee
    public function inactiveTrash(Request $request)
    {
        $data = Employee::mine()->inactive()->onlyTrashed()
            ->with('department:id,name')
            ->with('designation:id,name')
            ->with('employeeType:id,name')
            ->select('id', 'status', 'department_id', 'designation_id', 'type_id', 'employee_index', 'first_name', 'last_name', 'email', 'phone', 'device_id')
            ->where('status', RootModel::STATUS_INACTIVE);

        //department filter and scope:
        $data = (\request()->filled('department_id') ? $data->where('department_id', \request()->get('department_id'))
            :(Auth::user()->department_id ? $data->where('department_id', Auth::user()->department_id) : $data));

        //Designation  filter;
        return (\request()->filled('designation_id') ? $data->where('designation_id', \request()->get('designation_id')): $data);
    }


    /*Store department*/
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $employee = $this->model->create([
                'employee_index' => $request->get('employee_index'),
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'joining_date' => $request->get('joining_date'),
                'card_no' => $request->get('card_no'),
                'status' => $request->get('status'),
            ]);

            if (config('company_settings.allow_employee_login') && $request->get('create_user')) {
                User::create([
                    'com_id' => com_id(),
                    'branch_id' => branch_id(),
                    'name' => $request->get('first_name') . ' ' . $request->get('last_name'),
                    'email' => $request->get('email'),
                    'role_id' => $request->get('role_id'),
                    'level' => User::USER_EMPLOYEE,
                    'employee_id' => $employee->id,
                    'password' => bcrypt($request->get('password')),
                    'status' => $request->get('status'),
                ]);
            }

            DB::commit();

            return $employee->id;

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Employee create Failed");
            Log::info(get_exception_message($exception));
            return false;
        }

    }


    //delete Department
    public function destroy($model): bool
    {
        try {

            DB::beginTransaction();

            Schema::disableForeignKeyConstraints();

            $employee = $this->model->where('id', $model)->first();

            if ($employee->user){
                $employee->user->forceDelete();
            }

            $employee->forceDelete();

            DB::commit();
            Schema::enableForeignKeyConstraints();

        } catch (\Exception $exception) {

            DB::rollBack();

            Log::error('Delete Failed');
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


    /**get Employee Details*/

    public function show($id)
    {
        return $this->model->with(
            'designation:id,name', 'user:id,employee_id,role_id', 'educations', 'documents', 'addresses', 'addresses.country'
        )
            ->select(Employee::$fetch)
            ->where('id', $id)->first();
    }


    /*Update department*/
    public function updateEmploymentInfo(Request $request, $id): bool
    {
        try {
            DB::beginTransaction();

            $employee = $this->model->where('id', $id)->first();
            //dd(Carbon::createFromDate($request->get('joining_date')));

            $employee->update([
                'department_id' => $request->get('department_id'),
                'designation_id' => $request->get('designation_id'),
                'shift_id' => $request->get('shift_id'),
                'provision_period' => $request->get('provision_period'),
                'allow_overtime' => $request->get('allow_overtime'),
                'overtime_allowance' => $request->get('overtime_allowance'),
                'allowance_percent' => $request->get('allowance_percent'),
                'type_id' => $request->get('type_id'),
                'leave_policy_id' => $request->get('leave_policy_id'),
                'basic_salary' => $request->get('basic_salary'),
                'joining_date' => $request->get('joining_date'),
                'provident_maturity_date' => $request->get('provident_maturity_date'),
                'insurance_maturity_date' => $request->get('insurance_maturity_date'),
                'status' => $request->get('status'),
                'card_no' => $request->get('card_no'),
                'device_id' => $request->get('device_id'),
            ]);

            if ($employee->user) {
                $employee->user->update([
                    'role_id' => $request->get('role_id'),
                    'level' => User::USER_EMPLOYEE,
                    'status' => $request->get('status'),
                ]);
            }

            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Employee update Failed");
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }

    /**update Partial  info*/
    public function updatePersonalInfo(Request $request, $id): bool
    {
        try {
            DB::beginTransaction();

            $employee = $this->model->where('id', $id)->first();

            if ($request->hasFile('image')) {
                $employee->updateImage($request->file('image'), 'profile');
            }

            //dd(Carbon::createFromDate($request->get('joining_date')));
            $employee->update([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'gender' => $request->get('gender'),
                'dob' => $request->get('dob'),
                'marital_status' => $request->get('marital_status'),
            ]);

            if ($employee->user) {
                $employee->user->update([
                    'name' => $employee->full_name,
                    'email' => $request->get('email'),
                ]);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Employee update Failed");
            Log::info(get_exception_message($e));
            return false;
        }

        return true;

    }


    /** store Education  info*/
    public function storeEducation(Request $request): bool
    {
        try {

            EmployeeEducation::create($request->validated());

        } catch (\Exception $exception) {

            Log::error("Employee Education update Failed");
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


    /** update Education  info*/
    public function updateEducation(Request $request, EmployeeEducation $education): bool
    {
        try {

            $education->update($request->validated());

        } catch (\Exception $exception) {

            Log::error("Employee Education update Failed");
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


    /** store Education  info*/
    public function storeAddress(Request $request): bool
    {
        $employee = Employee::find($request->get('employee_id'));

        try {

            $employee->addresses()->create($request->validated());

        } catch (\Exception $exception) {
            Log::error("Employee Address update Failed");
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


    /** update Education  info*/
    public function updateAddress(Request $request, Address $address): bool
    {
        try {

            $address->update($request->validated());

        } catch (\Exception $exception) {

            Log::error("Employee Address update Failed");
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


    /** store Education  info*/
    public function storeDocument(Request $request): bool
    {
        $employee = Employee::find($request->get('employee_id'));

        try {
            if ($request->has('file')) {

                $employee->saveDocument($request->file('file'), $request->get('name'), 1);
            }

        } catch (\Exception $exception) {
            Log::error("Employee Documents store Failed");
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


    /** update Education  info*/
    public function destroyDocument($employee, $document): bool
    {
        try {

            $employee->deleteDocument($document);

        } catch (\Exception $exception) {
            Log::error("Employee document delete Failed");
            Log::info(get_exception_message($exception));
            return false;
        }

        return true;
    }


    private function employeeCount($table, $request = null)
    {
        $query = \Illuminate\Support\Facades\DB::table($table);

        if (
            $request->filled('company_id')
            || $request->filled('branch_id')
            || $request->filled('department_id')
            || $request->filled('designation_id')
        ) {
            if ($request->filled('company_id')) {
                $query->where('com_id', $request->get('company_id'));

                if (! $request->filled('branch_id')) {
                    $query->where('branch_id', null);
                }
            }
            if ($request->filled('branch_id')) {
                $query->where('branch_id', $request->get('branch_id'));
            }
            if ($request->filled('department_id')) {
                $query->where('department_id', $request->get('department_id'));
            }
            if ($request->filled('designation_id')) {
                $query->where('designation_id', $request->get('designation_id'));
            }

            return $query->count();
        }
        else {

            if (is_branch_admin()) {
                return $query->where('branch_id', branch_id())->count();
            }

            if (is_company_admin()) {
                return $query->where('com_id', com_id())->where('branch_id', null)->count();
            }

            return $query->count();
        }
    }


    private function getFilter($data, $request)
    {
        if (
            $request->filled('company_id')
            || $request->filled('branch_id')
            || $request->filled('department_id')
            || $request->filled('designation_id')
        ) {
            if ($request->filled('company_id')) {
                $data->where('employees.com_id', $request->get('company_id'));
                if (! $request->filled('branch_id')) {
                    $data->where('employees.branch_id', null);
                }
            }

            if ($request->filled('branch_id')) {
                $data->where('employees.branch_id', $request->get('branch_id'));
            }

            if ($request->filled('department_id')) {
                $data->where('employees.department_id', $request->get('department_id'));
            }

            if ($request->filled('designation_id')) {
                $data->where('employees.designation_id', $request->get('designation_id'));
            }

            return $data;
        }

        if (branch_id()) {
            return $data->where('employees.branch_id', branch_id());
        }
        if (com_id()) {
            return $data->where('employees.com_id', com_id())
                ->where('employees.branch_id', null);
        }

        return $data;

    }


    public function getEducations($empId)
    {
        $data = EmployeeEducation::where('employee_id', $empId);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('approval_status', function ($row) {
                return  get_approval_status($row->status);
            })->addColumn('action', function ($row) {
                return edit_button('employee.education.edit', $row->id) . delete_button('employee.education.delete', $row->id);
            })
            ->rawColumns(['action'])
            ->make(true);
    }





}
