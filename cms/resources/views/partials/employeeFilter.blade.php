<div class="col-md-{{$col}}">
    <select class="full-width form-control select2-ajax w-100" data-text="{{trans('help.search_employee')}}"
            data-link="{{route('employee.getEmployee')}}" name="employee_id" id="employee-filter">
        <option value="">{{trans('app.select_employee')}}</option>
    </select>
</div>
