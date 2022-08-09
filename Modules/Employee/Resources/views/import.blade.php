@extends('layouts.modal', ['size' => 'md'])
@php
    //dd(get_employee_leaveTypes())
@endphp

@section('modal')

    <div class="form-body">
        <div class="row">

            <p class="example-file">
            <span> Here you can upload your employees. here is
                <a class="text-warning" href="{{asset('/example.xlsx')}}" download target="_blank">{{trans('app.example_file')}}</a>
            </span>
                <strong>Note: </strong> Maximum employee upload limit {{config('system.csv_import_limit')}} <br/>
                <strong>Note: </strong> If you don't want to create employee login access left empty the password filed
            </p>

            <div class="clearfix"></div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="attachment">
                    {{trans('app.attachment')}}
                </label>
                <div class="item form-group">
                    <input class="custom-file" type="file" required placeholder="1.0" id="attachment" name="attachment"/>
                </div>
            </div>

        </div>
    </div>

@endsection



