@extends('layouts.modal', ['size' => 'lg'])
@php
    $deduction = 0;
    $add = 0;
@endphp
@section('modal')
    <section class="content invoice mt-2">
        <!-- title row -->
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
                <address>
                    <strong>{{trans('app.name')}} :</strong> <br>
                    <strong>{{trans('app.department')}} : </strong> <br>
                    <strong>{{trans('app.designation')}} : </strong> <br>
                    <strong>{{trans('app.salary_month')}} : </strong>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-6 invoice-col">
                <address>
                    <strong>{{ $salary->employee_name }} </strong> <br>
                    <strong>{{ $salary->employee->department->name }} </strong> <br>
                    <strong>{{ $salary->employee->designation->name }} </strong> <br>
                    <strong>{{ \Illuminate\Support\Carbon::parse($salary->month)->format('F-Y') }} </strong> <br>
                </address>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Table row -->
        <div class="row">
            <div class="col-sm-6">
                <table class="table table-striped">
                    <thead>
                    <tr class="height-10">
                        <th>{{trans('app.allowances')}}</th>
                        <th>{{trans('app.subtotal')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salary->details[\Modules\Payroll\Entities\SalaryStructure::TYPE_ADD] as $detail)
                        @foreach ($detail as $key => $val)
                            @php
                                $add += $val;
                            @endphp
                            <tr class="height-10">
                                <td>{{ $key }} </td>
                                <td>{{get_formatted_currency($val, 2)}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    <td> {{trans('app.other_allowance')}} </td>
                    <td>{{get_formatted_currency($salary->other_allowance, 2)}}</td>
                    @php
                        $add += $salary->other_allowance;
                    @endphp
                    </tbody>
                </table>
            </div>

            <div class="col-sm-6">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{trans('app.deductions')}}</th>
                        <th>{{trans('app.subtotal')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salary->details[\Modules\Payroll\Entities\SalaryStructure::TYPE_DEDUCT] as $detail)
                        @foreach ($detail as $key => $val)
                            @php
                                $deduction += $val;
                            @endphp
                            <tr class="height-10">
                                <td>{{ $key }} </td>
                                <td>{{get_formatted_currency($val, 2)}}</td>
                            </tr>
                        @endforeach
                    @endforeach

                    <td> {{trans('app.other_deduction')}} </td>
                    <td>{{get_formatted_currency($salary->other_deduction, 2)}}</td>
                    @php
                        $deduction += $salary->other_deduction;
                    @endphp
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-sm-12">
                <p class="lead">{{trans('app.summery')}}</p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th class="w-50">{{trans('app.basic_salary')}}
                            </th>
                            <td>{{get_formatted_currency($salary->basic_salary, 2)}}
                            </td>
                        </tr>
                        <tr>
                            <th class="w-50">{{trans('app.allowances')}}</th>
                            <td> {{ get_formatted_currency($add, 2) }}</td>
                        </tr>
                        <tr>
                            <th class="w-50">{{trans('app.deductions')}}</th>
                            <td>- {{ str_replace('-', '', get_formatted_currency($deduction, 2)) }}</td>
                        </tr>
                        <tr>
                            <th class="w-50">{{trans('app.tax')}}</th>
                            <td>- {{get_formatted_currency($salary->tax, 2)}}</td>
                        </tr>
                        <tr>
                            <th class="w-50">{{trans('app.total')}}</th>
                            <td>{{ get_formatted_currency(($salary->total), 2) }}</td>
                        </tr>
                        <tr>
                            <th class="w-50">{{trans('app.paid_amount')}}</th>
                            <td>{{ get_formatted_currency(($salary->paid_amount), 2) }}</td>
                        </tr>
                        <tr>
                            <th class="w-50">{{trans('app.due_amount')}}</th>
                            <td>{{ get_formatted_currency(($salary->due_amount), 2) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        @if($salary->is_paid == \Modules\Payroll\Entities\Salary::IS_NOT_PAID
                || $salary->is_paid ==  \Modules\Payroll\Entities\Salary::IS_PARTIAL_PAID
                )
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-sm-12">
                    <p class="lead">{{trans('app.payment_options')}}</p>
                    <div class="table-responsive">

                        <div class="col-md-6 col-sm-6">
                            <label class="col-form-label label-align" for="is_paid">
                                {{trans('app.payment_status')}} <span class="required">*</span>
                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                                   title="{{ trans('help.payment_status')}}"></i>
                            </label>
                            <div class="item form-group">
                                <select class="form-control w-100" id="is_paid" name="is_paid"
                                        required>
                                    <option value="{{\Modules\Payroll\Entities\Salary::IS_PAID}}">{{trans('app.full_payment')}}</option>
                                    <option value="{{\Modules\Payroll\Entities\Salary::IS_PARTIAL_PAID}}">{{trans('app.partial_payment')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label class="col-form-label label-align" for="amount">
                                {{trans('app.amount')}} <span class="required">*</span>
                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.amount')}}"></i>
                            </label>
                            <div class="item form-group">
                                <input class="form-control" type="number" step=".01" id="amount" name="amount" required placeholder="00.00" value="{{number_format($salary->due_amount, 2, '.', '')}}">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.col -->
            </div>
        @endif

    </section>
@endsection
