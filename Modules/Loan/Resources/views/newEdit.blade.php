@extends('layouts.modal', ['size' => 'lg'])

@section('modal')

    @php
        //dd($loan);
    @endphp

    <div class="showNotification"></div>

    <div class="form-body">
        <div class="row">
            @if(! is_employee_user())
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="employee_id">
                        {{trans('app.employee')}} <span class="required">*</span>
                    </label>
                    <div class="item form-group">
                        <select class="form-control select2-ajax checkProvision" data-link="{{route('employee.getEmployee')}}" autofocus id="employee_id"
                                name="employee_id" required>
                            @if(! empty($loan->employee))
                                <option value="{{$loan->employee->id}}" selected> {{$loan->employee->name}} </option>
                            @endif
                        </select>
                    </div>
                </div>
            @endif

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="loan_type">
                    {{trans('app.type')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="type" id="loan_type">
                        <option value="">{{trans('app.select')}}</option>
                        @foreach(config('loan.type') as $type)
                            <option value="{{$type['key']}}"
                                @if($loan)
                                    @if($type['key'] == $loan->type) selected @endif
                                @endif> {{$type['value']}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 hide" id="interestPercent">
                <label class="col-form-label label-align" for="interest_percent">
                    {{trans('app.interest_percent')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="interest_percent" class="form-control" type="number" step=".01"  name="interest_percent"
                           value="@if($loan){{ (float)$loan->interest_percent }}@endif" placeholder="00.00">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="loan_amount">
                    {{trans('app.loan_amount')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="loan_amount" class="form-control" type="number" step=".01"  name="loan_amount"
                           value="@if($loan){{ (float)$loan->loan_amount }}@endif" placeholder="00.00">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="installments">
                    {{trans('app.installments')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="installments" class="form-control" type="number" step=".01"  name="installments"
                           value="@if($loan){{ $loan->installments }}@endif" placeholder="0">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="installment_amount">
                    {{trans('app.installment_amount')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input id="installment_amount" readonly class="form-control" type="number" step=".01" name="installment_amount"
                           value="@if($loan){{ (float)$loan->installment_amount }}@endif" placeholder="00.00">
                </div>
            </div>


            @if(! is_employee())
            {{--Status--}}
                <div class="col-md-6 col-sm-6">
                    <label class="col-form-label label-align" for="status">
                        {{trans('app.status')}} <span class="required">*</span>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" name="status" id="status">
                            <option value="">{{trans('app.select')}}</option>
                            @foreach(config('loan.status') as $status)
                                <option value="{{$status['key']}}"
                                    @if($loan)
                                        @if($status['key'] == $loan->status) selected @endif
                                    @endif> {{$status['value']}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="details">
                    {{trans('app.details')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <textarea id="details" class="form-control" name="details" placeholder="{{trans('app.details')}}">@if($loan){{$loan->details}}@endif</textarea>
                </div>
            </div>

        </div>
    </div>

@endsection

@include('loan::scripts.formScript')


