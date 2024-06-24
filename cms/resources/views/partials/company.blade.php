<div class="col-md-{{$col}} col-sm-{{$col}} col-12">
    <label class="col-form-label label-align" for="branch">
        {{trans('app.branch')}} @if($required) <span class="required">*</span> @endif <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.branch')}}"></i>
    </label>
    <select class="form-control" name="com_id" id="branch" @if($readOnly) disabled @endif @if($required) required @endif>
        <option value="">{{trans('app.select_branch')}}</option>
        @foreach(get_companies() as $key => $name)
            <option value="{{ $key }}" @if($comId == $key) selected @endif>{{ $name }}</option>
        @endforeach
    </select>
</div>

