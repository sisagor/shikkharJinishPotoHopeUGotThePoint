@extends('layouts.viewModal', [
    'size' => 'md', 'title' => 'payslip',
    'print' => true, 'url' => route('payroll.salary.payslip.print', $salary)
])
@php
    $deduction = 0;
    $add = 0;
@endphp
@section('viewModal')
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
        <div class="row hide">
            <div class="col-sm-6">
                <table class="table table-striped">
                    <thead>
                    <tr class="height-10">
                        <th>{{trans('app.allowances')}}</th>
                        <th>{{trans('app.subtotal')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salary->details['add'] as $detail)
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
                    <td> Other Allowance </td>
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
                    @foreach($salary->details['deduct'] as $detail)
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
                    <td> Other Deduction </td>
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
                            <td>- {{ get_formatted_currency($deduction, 2) }}</td>
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
    </section>
@endsection
