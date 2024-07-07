<?php

namespace Modules\Employee\Http\Controllers;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Address;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Modules\Employee\Entities\Employee;
use Illuminate\Support\Facades\Artisan;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Support\Renderable;
use Modules\Employee\Entities\EmployeeEducation;
use Modules\Employee\Entities\EmployeeImporter;
use Modules\Timesheet\Entities\LeaveApplication;
use Modules\Employee\Http\Requests\AddressCreateRequest;
use Modules\Employee\Http\Requests\AddressUpdateRequest;
use Modules\Employee\Http\Requests\DocumentCreateRequest;
use Modules\Employee\Http\Requests\EmployeeCreateRequest;
use Modules\Employee\Http\Requests\EducationCreateRequest;
use Modules\Employee\Http\Requests\EducationUpdateRequest;
use Modules\Employee\Http\Requests\EmploymentUpdateRequest;
use Modules\Employee\Http\Requests\PersonalInfoUpdateRequest;
use Modules\Employee\Repositories\EmployeeRepositoryInterface;


class EmployeeController extends Controller
{
    protected $repository;

    public function __construct(EmployeeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        //Cache::forget('employees');
        if (!$request->ajax()) {
            return view('employee::index');
        }

        if ($request->get('type') == "active") {

            return DataTables::of($this->repository->all())
                ->addIndexColumn()
                //->setTotalRecords($this->employeeCount('employees', \request()))
                ->addColumn('action', function ($row) {
                    return view_button('employee.employee.view', $row->id, 0) . trash_button('employee.employee.trash', $row->id);
                })
                ->addColumn('department', function ($row) {
                    return $row->department->name ?? null;
                })
                ->addColumn('designation', function ($row) {
                    return $row->designation->name ?? null;
                })
                ->addColumn('full_name', function ($row) {
                    return $row->full_name;
                })
                ->addColumn('employee_type', function ($row) {
                    return $row->employeeType->name ?? null;
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if ($request->get('type') == "trash") {

            return DataTables::of($this->repository->trashOnly())
                ->addIndexColumn()
                //->setTotalRecords($this->employeeCount('employees', \request()))
                ->addColumn('action', function ($row) {
                    return restore_button('employee.employee.restore', $row->id) . delete_button('employee.employee.delete', $row->id);
                })
                ->addColumn('department', function ($row) {
                    return $row->department->name ?? null;
                })
                ->addColumn('designation', function ($row) {
                    return $row->designation->name ?? null;
                })
                ->addColumn('full_name', function ($row) {
                    return $row->full_name;
                })
                ->addColumn('employee_type', function ($row) {
                    return $row->employeeType->name ?? null;
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    /**
     * get inactive employees
     * @return Renderable
     */
    public function inactive(Request $request)
    {
        //Cache::forget('employees');
        if (!$request->ajax()) {
            return view('employee::inactive');
        }

        if ($request->get('type') == "active") {
            return DataTables::of($this->repository->inactive($request))
                ->addIndexColumn()
                //->setTotalRecords($this->employeeCount('employees', \request()))
                ->addColumn('action', function ($row) {
                    return view_button('employee.employee.view', $row->id, 0) . trash_button('employee.employee.trash', $row->id);
                })
                ->addColumn('department', function ($row) {
                    return $row->department->name ?? null;
                })
                ->addColumn('designation', function ($row) {
                    return $row->designation->name ?? null;
                })
                ->addColumn('employee_type', function ($row) {
                    return $row->employeeType->name ?? null;
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if ($request->get('type') == "trash") {
            return DataTables::of($this->repository->inactiveTrash($request))
                ->addIndexColumn()
                //->setTotalRecords($this->employeeCount('employees', \request()))
                ->addColumn('action', function ($row) {
                    return restore_button('employee.employee.restore', $row->id) . delete_button('employee.employee.delete', $row->id);
                })
                ->addColumn('department', function ($row) {
                    return $row->department->name ?? null;
                })
                ->addColumn('designation', function ($row) {
                    return $row->designation->name ?? null;
                })
                ->addColumn('employee_type', function ($row) {
                    return $row->employeeType->name ?? null;
                })
                ->editColumn('status', function ($row) {
                    return get_status($row->status);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(): Renderable
    {
        set_action('employee.employee.store');
        set_action_title('new_employee');
        $employee = [];
        $empId = make_employee_unique_id();

        return view('employee::new', compact('employee', 'empId'));
    }

    /**
     * Store employee information to the storage
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(EmployeeCreateRequest $request): RedirectResponse
    {
        $store = $this->repository->store($request);

        if ($store) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.employee')]));

            return redirect()->route('employee.employee.view', $store)->with('success', trans('msg.create_success', ['model' => trans('model.employee')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.employee')]))->withInput();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        $employee = $this->repository->show($id);

        // dd($employee);

        (is_employee() ? Session::put('tab', 'personal') : Session::put('tab', 'employment'));

        return view('employee::show', compact('employee'));
    }

    /**
     * Update employee employment information
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updateEmploymentInfo(EmploymentUpdateRequest $request, $id): RedirectResponse
    {
        Session::put('tab', 'employment');
        $update = $this->repository->updateEmploymentInfo($request, $id);

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.employee')]));
            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.employee')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.employee')]));
    }


    /**
     * update employee personal information
     * @param int $id
     * @return RedirectResponse
     */
    public function updatePersonalInfo(PersonalInfoUpdateRequest $request, $id): RedirectResponse
    {
        Session::put('tab', 'personal');

        $update = $this->repository->updatePersonalInfo($request, $id);

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.employee')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.employee')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.employee')]));
    }

    /**
     *move to trash
     * @param int $id
     * @return RedirectResponse
     */
    public function trash($id): RedirectResponse
    {
        if ($this->repository->trash($id)) {
            sendActivityNotification(trans('msg.noty.soft_deleted', ['model' => trans('model.employee')]));
            return redirect()->back()->with('success', trans('msg.soft_delete_success', ['model' => trans('model.employee')]));
        }

        return redirect()->back()->with('error', trans('msg.soft_delete_failed', ['model' => trans('model.employee')]));
    }

    /**
     * restore employee
     * @param int $id
     * @return RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        $user = User::onlyTrashed()->where('employee_id', $id)->restore();
        $emp = $this->repository->restore($id);

        if ($emp && $user) {

            sendActivityNotification(trans('msg.noty.restored', ['model' => trans('model.employee')]));
            return redirect()->back()->with('success', trans('msg.restore_success', ['model' => trans('model.employee')]));
        }

        return redirect()->back()->with('error', trans('msg.restore_failed', ['model' => trans('model.employee')]));
    }

    /**
     * Remove employee resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id): RedirectResponse
    {
        if ($this->repository->destroy($id)) {

            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.employee')]));
            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.employee')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.employee')]));
    }



    /**
     * Educations
     * @param $employeeId
     */
    public function educations(Request $request, $employeeId)
    {
        if ($request->ajax()) {
            return $this->repository->getEducations($employeeId);
        }
    }

    /**
     *  Create Education
     * @return Renderable
     */
    public function createEducation($employeeId): Renderable
    {
        set_action('employee.education.store');
        set_action_title('new_education');
        return view('employee::education.newEdit', compact('employeeId'));
    }


    /**
     * Store Education
     * @return RedirectResponse
     */
    public function storeEducation(EducationCreateRequest $request): RedirectResponse
    {
        Session::put('tab', 'education');
        $create = $this->repository->storeEducation($request);

        if ($create) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.employee_education')]));
            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.employee_education')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.employee_education')]));
    }


    /**
     * Edit  Education
     * @return Renderable
     */
    public function editEducation(EmployeeEducation $education): Renderable
    {
        set_action('employee.education.update', $education);
        set_action_title('edit_education');
        return view('employee::education.newEdit', compact('education'));
    }


    /**
     * update Education
     * @return RedirectResponse
     */
    public function updateEducation(EducationUpdateRequest $request, EmployeeEducation $education): RedirectResponse
    {
        Session::put('tab', 'education');
        $update = $this->repository->updateEducation($request, $education);

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.employee_education')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.employee_education')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.employee_education')]));
    }


    /**
     * destroy Education
     * @param int $id
     * @return Renderable
     */
    public function destroyEducation(EmployeeEducation $education): RedirectResponse
    {
        Session::put('tab', 'education');
        $delete = $education->forceDelete();

        if ($delete) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.employee_education')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.employee_education')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.employee_education')]));
    }


    /**
     * Start Create Addresses
     * @return Renderable
     */
    public function createAddress($employeeId): Renderable
    {
        set_action('employee.address.store');
        set_action_title('new_address');
        $address = [];
        return view('employee::address.newEdit', compact('employeeId', 'address'));
    }


    /**
     * Store Education
     * @return RedirectResponse
     */
    public function storeAddress(AddressCreateRequest $request): RedirectResponse
    {
        Session::put('tab', 'address');

        $create = $this->repository->storeAddress($request);

        if ($create) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.address')]));
            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.address')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.address')]));
    }


    /**
     * Create Education
     * @return Renderable
     */
    public function editAddress(Address $address): Renderable
    {
        set_action('employee.address.update', $address);
        set_action_title('edit_address');

        return view('employee::address.newEdit', compact('address'));
    }


    /**
     * update Education
     * @return RedirectResponse
     */
    public function updateAddress(AddressUpdateRequest $request, Address $address): RedirectResponse
    {
        Session::put('tab', 'address');

        $update = $this->repository->updateAddress($request, $address);

        if ($update) {
            sendActivityNotification(trans('msg.noty.updated', ['model' => trans('model.address')]));

            return redirect()->back()->with('success', trans('msg.update_success', ['model' => trans('model.address')]));
        }

        return redirect()->back()->with('error', trans('msg.update_failed', ['model' => trans('model.address')]));
    }


    /**
     * destroy Education
     * @param int $id
     * @return Renderable
     */
    public function destroyAddress(Address $address): RedirectResponse
    {
        Session::put('tab', 'address');

        $delete = $address->forceDelete();

        if ($delete) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.address')]));

            return redirect()->back()->with('success', trans('msg.delete_success', ['model' => trans('model.address')]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.address')]));
    }


    /**
     * Start Create Documents
     * @return Renderable
     */
    public function createDocument($employeeId): Renderable
    {
        set_action('employee.document.store');
        set_action_title('new_document');
        $document = [];
        return view('employee::document.newEdit', compact('employeeId', 'document'));
    }


    /**
     * Store Education
     * @return RedirectResponse
     */
    public function storeDocument(DocumentCreateRequest $request): RedirectResponse
    {
        Session::put('tab', 'document');

        $create = $this->repository->storeDocument($request);

        if ($create) {
            sendActivityNotification(trans('msg.noty.created', ['model' => trans('model.document')]));

            return redirect()->back()->with('success', trans('msg.create_success', ['model' => trans('model.document')]));
        }

        return redirect()->back()->with('error', trans('msg.create_failed', ['model' => trans('model.document')]));
    }

    /**
     * destroy Education
     * @param int $id
     * @return Renderable
     */
    public function destroyDocument(Employee $employee, Document $document): RedirectResponse
    {
        Session::put('tab', 'document');

        $delete = $this->repository->destroyDocument($employee, $document);

        if ($delete) {
            sendActivityNotification(trans('msg.noty.deleted', ['model' => trans('model.document')]));

            return redirect()->back()->with('success', trans('msg.delete_success', [
                'model' => trans('model.document')
            ]));
        }

        return redirect()->back()->with('error', trans('msg.delete_failed', ['model' => trans('model.document')]));
    }


    /**
     * get employee via ajax from throughout the system
     * @param int $id
     * @return Renderable
     */
    public function getEmployeeAjax(Request $request): JsonResponse
    {
        ///Temporary status inactive: it should be active:
        $employees = Employee::active()
            ->where(function ($name) use ($request) {
                $name->where('employee_index', 'LIKE', $request->get('search') . '%');
            })
            ->select('id', 'name as text');

        if (is_company_admin()) {
            $employees->companyScope();
        }
        if (is_branch_admin()) {
            $employees->branchScope();
        }

        $employees = $employees->get();

        if ($employees) {
            return \response()->json($employees);
        }

        return \response()->json(['id' => 0, 'text' => 'result not found!!']);
    }


    /**
     * get leave policy via ajax from throughout the system
     * @return JsonResponse
     */
    public function getLeavePolicy(Request $request)
    {
        $employee = Employee::with('leavePolicy:id,type_id,name')
            ->select('id', 'leave_policy_id')
            ->where('id', $request->get('empId'))
            ->first();

        if (!empty($employee->leavePolicy->type_id)) {
            return \response()->json($employee->leavePolicy->type_id);
        }

        return \response()->json([]);
    }


    /**
     * get taken leave via ajax from throughout the system
     * @return JsonResponse
     */
    public function getTakenLeave(Request $request)
    {
        $data = ['levels' => [], 'data' => []];

        $period = Carbon::now()->subMonths(11)->monthsUntil(Carbon::now());

        foreach ($period as $date) {
            array_push($data['levels'], $date->format('F-Y'));

            $leave = LeaveApplication::whereHas('employee', function ($emp) use ($request) {
                $emp->where('id', $request->get('empId'));
            })
                ->where('end_date', 'LIKE', '%' . $date->format('Y-m') . '%')
                ->where('end_date', 'LIKE', '%' . $date->format('Y-m') . '%')
                ->groupBy(DB::raw('DATE_FORMAT(end_date, "%Y-%m")'))
                ->sum('leave_days');

            array_push($data['data'], $leave);
        }

        return \response()->json($data);
    }

    /**
     * Sync company employee information with device;
     * @return Renderable
     */
    public function syncCompanyEmployeeWithDevice(Request $request)
    {

        $sync = Artisan::call('inta:syncComEmp ' . com_id());

        if ($sync) {

            $message = "Sync employee successfully";
            return view('partials.systemMessage', compact('message'));
        }

        $message = "Sync Failed Try again after check your configuration";
        return view('partials.systemMessage', compact('message'));
    }

    /**
     * Sync branch employee info with device
     * @return Renderable
     */
    public function syncBranchEmployeeWithDevice(Request $request)
    {

        $sync = Artisan::call('inta:syncBranchEmp ' . branch_id());

        if ($sync) {

            $message = "Sync employee successfully";
            return view('partials.systemMessage', compact('message'));
        }

        $message = "Sync Failed Try again after check your configuration";
        return view('partials.systemMessage', compact('message'));
    }


    /**
     * bulk upload employee information form
     * @return Renderable
     */
    public function bulkUploadExample(Request $request)
    {
        set_action_title('import_employee');
        set_action('employee.import.update');
        return view('employee::import');
    }

    /**
     * store bulk upload employee information
     * @return RedirectResponse
     */
    public function bulkUpload(Request $request)
    {

        $path = $request->file('attachment')->store('temp');

        $import = new EmployeeImporter;
        $create = \Excel::import($import, Storage::path($path));

        if ($create) {

            Storage::delete($path);

            return redirect()->back()->with('success', trans('msg.import_success', ['model' => trans('model.employee')]));
        }

        return redirect()->back()->with('error', trans('msg.import_failed', ['model' => trans('model.employee')]));
    }


    /**
     * Check provision period of employee
     * @return bool
     */
    public function checkProvisionPeriod(Request $request)
    {
        if (!config('company_settings.has_provision_period')) {
            return true;
        }

        $check = Employee::where('id', $request->get('id'))->select('provision_period', 'joining_date')->first();

        if (Carbon::parse($check->joiniing_date)->addMonths($check->provision_period)->greaterThan(Carbon::now())) {
            return true;
        } else {
            return false;
        }
    }
}
