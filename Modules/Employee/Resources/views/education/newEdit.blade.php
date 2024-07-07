@extends('layouts.modal', ['size' => 'md'])

@section('modal')
    <div class="form-body">
        <div class="row">

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="exam_title">
                    {{ trans('app.exam_title') }} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                        title="{{ trans('help.employee_exam_title') }}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="exam_title" name="exam_title" required
                        value="@if (isset($education)) {{ $education->exam_title }} @endif"
                        placeholder="{{ trans('app.exam_title') }}" />
                    <input type="hidden" name="employee_id"
                        value="@if (isset($employeeId)) {{ $employeeId }} @endif" />
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="institute">
                    {{ trans('app.institute_name') }} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                        title="{{ trans('help.institute_name') }}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="institute" name="institute" required
                        value="@if (isset($education)) {{ $education->institute }} @endif"
                        placeholder="{{ trans('app.institute_name') }}" />
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="passing_year">
                    {{ trans('app.passing_year') }} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                        title="{{ trans('help.employee_passing_year') }}"></i>
                </label>
                <div class="item form-group">
                    <input type="text" class="form-control" name="passing_year" required
                        value="@if (isset($education)) {{ $education->passing_year }} @endif"
                        placeholder="{{ trans('app.passing_year') }}" />
                </div>
            </div>

            {{-- <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="educational_qualification">
                    {{ trans('app.educational_qualification') }}
                    <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                        title="{{ trans('help.educational_qualification') }}"></i>
                </label>
                <div class="item form-group">
                    <input type="text" class="form-control" name="educational_qualification" required
                        value="@if (isset($education)) {{ $education->educational_qualification }} @endif"
                        placeholder="{{ trans('app.educational_qualification') }}" />
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="actual_degree">
                    {{ trans('app.actual_degree') }}
                    <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                        title="{{ trans('help.actual_degree') }}"></i>
                </label>
                <div class="item form-group">
                    <input type="text" class="form-control" name="actual_degree" required
                        value="@if (isset($education)) {{ $education->actual_degree }} @endif"
                        placeholder="{{ trans('app.actual_degree') }}" />
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="educational_discipline">
                    {{ trans('app.educational_discipline') }}
                    <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                        title="{{ trans('help.educational_discipline') }}"></i>
                </label>
                <div class="item form-group">
                    <input type="text" class="form-control" name="educational_discipline" required
                        value="@if (isset($education)) {{ $education->educational_discipline }} @endif"
                        placeholder="{{ trans('app.educational_discipline') }}" />
                </div>
            </div> --}}

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="cgpa">
                    {{ trans('app.cgpa') }} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                        title="{{ trans('help.employee_cgpa') }}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="number" step=".01" id="cgpa" name="cgpa" required
                        value="@if (isset($education)) {{ $education->cgpa }} @endif"
                        placeholder="{{ trans('app.cgpa') }}" />
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="out_of">
                    {{ trans('app.out_of') }} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                        title="{{ trans('help.employee_out_of') }}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="number" step=".01" id="out_of" name="out_of" required
                        value="@if (isset($education)) {{ $education->out_of }} @endif"
                        placeholder="{{ trans('app.out_of') }}" />
                </div>
            </div>

        </div>
    </div>
@endsection
