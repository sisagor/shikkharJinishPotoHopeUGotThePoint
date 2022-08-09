<?php

namespace App\Common;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Filter
{
    private $query;
    private $returnQquery;
    private $request;

    public function __construct(Request $request, $query)
    {
        $this->query = $query;
        $this->request = $request;
    }

    //company and branch filter and scope:
    public function commonScopeFilter($data = array()): Filter
    {

        /**Company Filter*/
        $this->returnQquery = ( $this->request->filled('com_id') && !empty($data['com_id']) && !empty($data['branch_id'])
            ?$this->query->where($data['com_id'] ,$this->request->get('com_id'))
            : (is_company_group() && $this->request->filled('branch_id')
                ? $this->query->where($data['com_id'], com_id())//->whereNull('attendance_log.branch_id')
                : ( is_admin_group() ? $this->query
                    : (! is_branch_group() ? $this->query->where($data['com_id'], com_id())->whereNull($data['branch_id']) : $this->query)
                )
            )
        );
        //end Company Filter


        /**Branch Filter*/
        $this->returnQquery = ($this->request->filled('branch_id') && ! empty($data['branch_id'])
            ? $this->query->where($data['branch_id'], $this->request->get('branch_id'))
            : (is_branch_group()
                ? $this->query->where($data['branch_id'], branch_id())
                : $this->query)
        );
        //end Branch Filter

        return $this;
    }

    //Date  filter
    public function dateFilter($data = array()): Filter
    {
        /**date Search*/
        $this->returnQquery = ($this->request->filled('from_date') && $data['from_date']
            ? $this->query->where($data['from_date'], '>=', Carbon::parse($this->request->get('from_date'))->startOfDay())
            : $this->query);

        $this->returnQquery = ($this->request->filled('to_date') && $data['to_date']
            ? $this->query->where($data['to_date'], '<=', Carbon::parse($this->request->get('to_date'))->endOfDay())
            : $this->query);
        /**End date Search*/

        return $this;
    }


    //Department filter and department user scope;
    public  function departmentScopeFilter($data = array()) : Filter
    {
        /**department user data*/
        $this->returnQquery = (Auth::user()->department_id && $data['department_id']
            ? $this->query->where($data['department_id'], Auth::user()->department_id)
            : ($this->request->filled('department_id') ? $this->query->where($data['department_id'], $this->request->get('department_id')) : $this->query)
        );

        return $this;
    }


    //Employee filter and scope;
    public  function employeeScopeFilter($data = array()): Filter
    {
        /**employee search employee user data*/
        $this->returnQquery = ($this->request->filled('employee_id') && !empty($data['employee_id'])
            ? $this->query->where($data['employee_id'], $this->request->get('employee_id'))
            : (is_employee() && $data['employee_id'] ? $this->query->where($data['employee_id'],  is_employee()) : $this->query)
        );
        /**employee user data*/
        return $this;
    }


    //Month filter
    public function monthFilter($data = array()): Filter
    {
        $this->returnQquery = (($this->request->filled('month') && $data['month'])
            ?  $this->query->where($data['month'], 'LIKE', $this->request->get('month') . '%')
            : $this->query);
        return $this;
    }

    //Month filter
    public function statusFilter($data = array()): Filter
    {
        $this->returnQquery = (($this->request->filled('status') && $data['status'])
            ?  $this->query->where($data['status'], $this->request->get('status'))
            : $this->query);
        return $this;
    }

    //execute the filter and Return query
    public function execute()
    {
        return $this->returnQquery;
    }

}
