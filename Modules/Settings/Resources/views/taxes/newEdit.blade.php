@extends('layouts.modal', ['size' => 'md'])

@section('modal')
    <div class="form-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="eligible_amount">
                    {{trans('app.eligible_amount')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="number" step=".01" id="eligible_amount" name="eligible_amount" required
                           value="@if(! empty($tax)){{$tax->eligible_amount}}@endif"
                           placeholder="{{trans('app.eligible_amount') }}">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="tax">
                    {{trans('app.tax')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="tax" step=".01" type="number" name="tax" required
                           value="@if($tax){{$tax->tax}}@endif" placeholder="{{trans('app.tax')}}">
                </div>
            </div>


            {{--Status--}}
            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="status">
                    {{trans('app.status')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="status" id="status">
                        <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}"
                                @if($tax) @if($tax->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif @endif>
                            {{trans('app.active')}} </option>
                        <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                                @if($tax) @if($tax->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif @endif>
                            {{trans('app.inactive')}} </option>
                    </select>
                </div>
            </div>

        </div>
    </div>
@endsection


