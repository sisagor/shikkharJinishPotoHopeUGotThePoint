<?php

namespace Modules\Payroll\Services;

use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Payroll\Entities\Salary;
use Modules\Settings\Entities\Tax;
use Modules\Settings\Entities\EmployeeType;
use Modules\Payroll\Entities\SalaryStructure;
use Modules\Organization\Entities\DeductionPolicy;


class SalaryGenerationService
{
    #Moth
    private $month;
    #basic Salary;
    private $basicSalary = 0;
    #allowances calculations;
    private $addTotal = 0;
    #deduction total;
    private $deductTotal = 0;
    ##detail container;
    private $details = [
        SalaryStructure::TYPE_ADD => [],
        SalaryStructure::TYPE_DEDUCT => [],
    ];
    #Absent;
    private $absent = 0;
    #late hour
    private $late = 0;
    ##Leave
    private $leave = 0;
    ##Holiday
    private $holidays = 0;
    #overrtime
    private $overtime = 0;
    #total attendance;
    private $attendance = 0;
    #working in holiday:
    private $extraDaysWork = 0;
    #Extra working hour
    private $extraDaysWorkHour = 0;

    private $employee;


    public function __construct($month, $employee)
    {
        $this->month = $month;
        $this->employee = (! empty($employee) ? $employee : []);
    }


    /*Generate salary*/
    public function generate($limit = 0)
    {
        try {
            ##days in month
            $daysInMonth = $this->month->daysInMonth;

            ##get employee with designation and salary rules and salary structure component:
            $employees = (new GetEligibleEmployeeService($this->month))->employees($this->employee);

            if (! count($employees)){
                return false;
            }

            foreach ($employees as $item)
            {

                $check = Salary::where('employee_id', $item->id)->where('month', $this->month->format('Y-m'))->count();

                if ($check){
                    Session::flash('warning', $item->employee_index.' Salary already generated for this month');
                    continue;
                }

                ##Assign Properties
                $this->basicSalary = (($item->basic_salary > 0)
                    ? $item->basic_salary
                    : (! empty($item->designation->salaryRule->basic_salary)
                        ? $item->designation->salaryRule->basic_salary
                        : 0)
                );

                $this->late = $item->late;
                $this->overtime = $item->overtime;
                $this->attendance = $item->present;
                $this->leave = $item->leave;
                $this->holidays = $item->company->holidays;

                //var_dump($this->attendance + $item->leave);
                //var_dump($daysInMonth - $this->holidays);
                //var_dump($this->month);
                //dd($this->holidays);

                #get if any extra day work
                $this->setExtraDayWork($item->attendances);



                //var_dump(($this->holidays));
               // dd( ($this->attendance + $item->leave));
                //dd(($daysInMonth - $this->holidays) > ($this->attendance + $item->leave));

                ###calculate absent present from attendance
               /* if (($daysInMonth - $this->holidays) > ($this->attendance + $item->leave)) {
                    //Log::error("Attendance missing");
                    //Log::info("Attendance missing from employee " . $item->employee_index);
                    throw new \Exception('Attendance missing from employee ' . $item->employee_index);
                }*/

                $this->absent = ($daysInMonth - ($this->attendance + $item->leave + $this->holidays));
                $this->absent = str_replace('-', '', $this->absent);

                ##Adjust attendances;
                $this->attendance = ($this->attendance - $this->extraDaysWork);



                ##if employee overtime define employee wise
                if ($item->allow_overtime && $item->overtime_allowance > 0) {

                    if ($item->allowance_percent) {
                        $addPercent = ($item->overtime_allowance / 100) * $this->basicSalary;

                        $totalOvertime = ($this->overtime * $addPercent);
                        //If extra working days exist
                        if ($this->extraDaysWork) {
                            $totalOvertime += ($this->extraDaysWorkHour * $addPercent);
                        }

                        $this->addTotal += $totalOvertime;
                        //dd($structure->salaryStructure->name);
                        array_push($this->details['add'], ['Overtime Allowance' => $totalOvertime]);
                    }
                    else {
                        //not percentage
                        $totalOvertime = ($this->overtime * $item->overtime_allowance);
                        //If extra working days exist
                        if ($this->extraDaysWork) {
                            $totalOvertime += ($this->extraDaysWorkHour * $item->overtime_allowance);
                        }

                        $this->addTotal += $totalOvertime;
                        //adding detail to the details container
                        array_push($this->details['add'], ['Overtime Allowance' => $totalOvertime]);
                    }
                }

                ##Start Salary rules Calculation
                #check if company allow allowances
                # && if employee type allow allowances
                # && if not under provision period
                if (
                    config('company_settings.has_allowances')
                    && $item->employeeType->allow_company_facility == EmployeeType::COMPANY_FACILITY_ALLOW
                    && ! $item->provision_period
                ) {
                    #itterate salary rules structures which created in salary rules
                    $this->setSalaryStructureOptions($item);
                }
                ##end Salary rules Calculation

                ##Start checking Attendance Deduction policy
                if ($this->basicSalary)
                {
                    $this->setAttendanceDeduction();
                }
                ##end deduction policy calculation

                ##Tax Calculation
                $tax = 0;
                if (config('system_settings.has_tax_policy'))
                {
                    $tax = $this->taxCalculation($item, (($this->addTotal + $this->basicSalary) - $this->deductTotal));
                }

                //Deduction total;
                $this->deductTotal = str_replace('-', '', $this->deductTotal);

                ##insert Salary:
                DB::table('salaries')->insert([
                    'com_id' => $item->com_id,
                    'branch_id' => $item->branch_id,
                    'employee_id' => $item->id,
                    'basic_salary' => $this->basicSalary,
                    'allowance' => $this->addTotal,
                    'deduction' => $this->deductTotal,
                    'month' => $this->month->format('Y-m'),
                    'details' => json_encode($this->details),
                    'tax' => $tax,
                    'total' => (($this->addTotal + $this->basicSalary) - ($this->deductTotal + $tax)),
                    'due_amount' => (($this->addTotal + $this->basicSalary) - ($this->deductTotal + $tax)),
                ]);
            };

        }
        catch (\Exception $exception)
        {
            dd($exception);
            Log::error("Salary generation error");
            Log::info(get_exception_message($exception));

            return false;
        }

        return true;
    }


    /**
     * calculate taxes
     */
    private function taxCalculation($employee, $salary)
    {
        $taxes = Tax::active()->select('eligible_amount', 'tax')->where('com_id', $employee->com_id)->orderBy('eligible_amount', 'desc')->get();

        foreach ($taxes as $tax) {
            if ($tax->eligible_amount <= $salary)
            {
                return ($tax->tax / 100) * $salary;
            }
        }

    }


    private function setAttendanceDeduction()
    {
        ##Start checking Attendance Deduction policy
        if (config('company_settings.has_attendance_deduction_policy')) {
            ## if it has absent or has late hour
            if ($this->absent || $this->late) {

                $policies = DeductionPolicy::commonScope()->select('type', 'absent', 'deduction_amount', 'is_percent')->get();

                foreach ($policies as $policy) {
                    #if policy type day
                    if ($policy->type == DeductionPolicy::TYPE_DAY) {
                        #if cut amount is Percentage
                        if ($policy->is_percent) {
                            $absentPercent = ($policy->deduction_amount / 100) * $this->basicSalary;

                            $absentPercent = ($absentPercent * $this->absent);
                            $this->deductTotal += $absentPercent;
                            if ($absentPercent) {
                                array_push($this->details[SalaryStructure::TYPE_DEDUCT], ['Absent Deduction' => $absentPercent]);
                            }
                        }
                        else {

                            $absentPercent = ($policy->deduction_amount);
                            $absentPercent = ($absentPercent * $this->absent);
                            $this->deductTotal += $absentPercent;
                            if ($absentPercent) {
                                array_push($this->details[SalaryStructure::TYPE_DEDUCT], ['Absent Deduction' => $absentPercent]);
                            }
                        }
                    }

                    #if policy type hour
                    if ($policy->type == DeductionPolicy::TYPE_HOUR) {
                        #if cut amount is Percentage
                        if ($policy->is_percent) {

                            $latePercent = ($policy->deduction_amount / 100) * $this->basicSalary;
                            $latePercent = ($latePercent * $this->late);
                            $this->deductTotal += $latePercent;
                            if ($latePercent){
                                array_push($this->details[SalaryStructure::TYPE_DEDUCT], ['Late Deduction' => $latePercent]);
                            }
                        }
                        else {

                            $lateDeduction = ($policy->deduction_amount);
                            $lateDeduction = ($lateDeduction * $this->late);
                            $this->deductTotal += $lateDeduction;
                            if ($lateDeduction) {
                                array_push($this->details[SalaryStructure::TYPE_DEDUCT], ['Late Deduction' => $lateDeduction]);
                            }
                        }
                    }
                }
            }
        }
    }


    private function setExtraDayWork($attendances)
    {
        $days = 0;

        foreach ($attendances as $att) {

            if (config('company_settings.allow_holiday_work_as_overtime')) {
                //Find if holiday attendance exist:

                $extraFind = DB::table('holidays')
                    ->where('holiday_month', Carbon::parse($att->attendance_date)->format('m'))
                    ->where('holiday_year', Carbon::parse($att->attendance_date)->format('Y'))
                    ->get();

                foreach ($extraFind as $extra){

                    if ($extra->days > 1)
                    {
                        $period = CarbonPeriod::create(Carbon::parse($extra->start_date), Carbon::parse($extra->end_date));

                        foreach ($period as $pr){
                            if ($pr->isSameDay(Carbon::parse($att->attendance_date))){
                                $days += 1;
                            }
                        }
                    }
                    else
                    {
                        if (Carbon::parse($extra->start_date)->isSameDay(Carbon::parse($att->attendance_date))){
                            $days += 1;
                        }
                    }
                }

                if ($days > 0) {
                    $this->extraDaysWork += $days;
                    $this->extraDaysWorkHour += $att->working_hour;
                }
            }
        }
    }


    private function setSalaryStructureOptions($item)
    {
        if(! empty($item->designation->salaryRule->salaryRuleStructure)){

            foreach ($item->designation->salaryRule->salaryRuleStructure as $structure) {
                ##if type add
                if ($structure->salaryStructure->type == SalaryStructure::TYPE_ADD) {
                    //If percentage
                    if ($structure->is_percent) {
                        $addPercent = ($structure->amount / 100) * $this->basicSalary;
                        $this->addTotal += $addPercent;
                        //dd($structure->salaryStructure->name);
                        array_push($this->details[SalaryStructure::TYPE_ADD], [$structure->salaryStructure->name => $addPercent]);
                    } else {
                        //not percentage
                        $this->addTotal += $structure->amount;
                        //adding detail to the details container
                        array_push($this->details[SalaryStructure::TYPE_ADD], [$structure->salaryStructure->name => $structure->amount]);
                    }
                }

                ##if type overtime and do not set in employee
                if (
                    $item->allow_overtime && $item->overtime_allowance < 1 && $structure->salaryStructure->type ==
                    SalaryStructure::TYPE_OVERTIME
                ) {
                    //If percentage
                    if ($structure->is_percent) {
                        $addPercent = ($structure->amount / 100) * $this->basicSalary;
                        $totalOvertime = ($this->overtime * $addPercent);


                        //If extra working days exist
                        if ($this->extraDaysWork) {
                            $totalOvertime += ($this->extraDaysWorkHour * $addPercent);
                        }

                        $this->addTotal += $totalOvertime;
                        //dd($structure->salaryStructure->name);
                        array_push($this->details[SalaryStructure::TYPE_ADD], [$structure->salaryStructure->name => $totalOvertime]);
                    } else {
                        //not percentage
                        $totalOvertime = ($this->overtime * $structure->amount);
                        //If extra working days exist
                        if ($this->extraDaysWork) {
                            $totalOvertime += ($this->extraDaysWorkHour * $structure->amount);
                        }
                        $this->addTotal += $totalOvertime;
                        //adding detail to the details container
                        array_push($this->details[SalaryStructure::TYPE_ADD], [$structure->salaryStructure->name => $totalOvertime]);
                    }
                }

                ##if type Deduct
                if ($structure->salaryStructure->type == SalaryStructure::TYPE_DEDUCT) {
                    //If percentage
                    if ($structure->is_percent) {
                        $deductPercent = ($structure->amount / 100) * $this->basicSalary;
                        $this->deductTotal += $deductPercent;
                        //dd($structure->salaryStructure->name);
                        array_push($this->details[SalaryStructure::TYPE_DEDUCT], [$structure->salaryStructure->name => $deductPercent]);
                    } else {
                        //not percentage
                        $this->deductTotal += $structure->amount;
                        //adding detail to the details container
                        array_push($this->details[SalaryStructure::TYPE_DEDUCT], [$structure->salaryStructure->name => $structure->amount]);
                    }
                }

                ##if type provident fund
                /* $providentMaturity = Carbon::parse($item->provident_maturity_date);
                 if (config('company_settings.has_provident_fund') && $providentMaturity->greaterThan($this->month)) {
                     if ($structure->salaryStructure->type == SalaryStructure::TYPE_PROVIDENT) {
                         //If percentage
                         $providentPercent = 0;
                         if ($structure->is_percent) {
                             $providentPercent = ($structure->amount / 100) * $this->basicSalary;
                             $this->deductTotal += $providentPercent;
                             //dd($structure->salaryStructure->name);
                             array_push($this->details['deduct'], [$structure->salaryStructure->name => $providentPercent]);
                         }
                         else {
                             //not percentage
                             $providentPercent = $structure->amount;
                             $this->deductTotal += $providentPercent;
                             //adding detail to the details container
                             array_push($this->details['deduct'], [$structure->salaryStructure->name => $providentPercent]);
                         }
                         #companyProvidentFundAMount
                         $providentFundCompanyAmount = (config('company_settings.provident_fund_company_amount_percent')
                             ? (config('company_settings.provident_fund_company_amount') / 100) * $this->basicSalary
                             : config('company_settings.provident_fund_company_amount'));
                         ##insert Provident_fund:
                         ProvidentFund::create([
                             'employee_id' => $item->id,
                             'employee_index' => $item->employee_index,
                             'employee_name' => $item->employee_name,
                             'employee_amount' => $providentPercent,
                             'company_amount' => $providentFundCompanyAmount,
                             'total' => ($providentPercent + $providentFundCompanyAmount)
                         ]);
                     }
                 }*/

                ##if type Insurance fund
                //$insuranceMaturityDate = Carbon::parse($item->insurance_maturity_date);

                /*  if (config('company_settings.has_insurance') && $insuranceMaturityDate->greaterThan($this->month)) {
                      if ($structure->salaryStructure->type == SalaryStructure::TYPE_INSURANCE) {
                          //If percentage
                          $insurancePercent = 0;
                          if ($structure->is_percent) {
                              $insurancePercent = ($structure->amount / 100) * $this->basicSalary;
                              $this->deductTotal += $insurancePercent;
                              //dd($structure->salaryStructure->name);
                              array_push($this->details['deduct'], [$structure->salaryStructure->name => $insurancePercent]);
                          }
                          else {
                              //not percentage
                              $insurancePercent = $structure->amount;
                              $this->deductTotal += $insurancePercent;
                              //adding detail to the details container
                              array_push($this->details['deduct'], [$structure->salaryStructure->name => $insurancePercent]);
                          }

                          ##insuranceCompanyAMount
                          #companyProvidentFundAMount
                          $insuranceCompanyAmount = (config('company_settings.insurance_company_amount_percent')
                              ? (config('company_settings.insurance_company_amount') / 100) * $this->basicSalary
                              : config('company_settings.insurance_company_amount'));
                          ##insert Insurance:
                          Insurance::create([
                              'employee_id' => $item->id,
                              'employee_index' => $item->employee_index,
                              'employee_name' => $item->employee_name,
                              'employee_amount' => $insurancePercent,
                              'company_amount' => $insuranceCompanyAmount,
                              'total' => ($insuranceCompanyAmount + $insurancePercent)
                          ]);
                      }
                  }*/

            }
        }

    }

}
