@extends('layouts.modal', ['size' => 'md'])

@section('modal')
    <div class="form-body">
        <div class="row">
            <input type="hidden" name="employee_id" value="{{$employeeId}}"/>
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.document_name')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.document_name')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="name" name="name" required
                           value="@if(! empty($document)){{$document->name}}@endif" placeholder="{{trans('app.name')
                        }}"/>
                </div>
            </div>


            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="document">
                    {{trans('app.document')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.document')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="file" name="file" required/>
                </div>
            </div>

        </div>
    </div>
@endsection


