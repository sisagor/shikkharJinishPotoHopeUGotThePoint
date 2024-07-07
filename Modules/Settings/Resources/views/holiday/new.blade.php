@extends('layouts.modal', ['size' => 'md'])

@section('modal')

    <div class="form-body">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="occasion">
                    {{trans('app.occasion')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.occasion')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="occasion" name="occasion"
                           placeholder="{{trans('app.occasion')}}" required>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="start_date">
                    {{trans('app.start_date')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.start_date')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" id="start_date" name="start_date" required/>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="end_date">
                    {{trans('app.end_date')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.holiday_end_date')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" id="end_date" name="end_date" required/>
                </div>
            </div>

            {{--Status--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}"> {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"> {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>

        </div>
    </div>

@endsection


