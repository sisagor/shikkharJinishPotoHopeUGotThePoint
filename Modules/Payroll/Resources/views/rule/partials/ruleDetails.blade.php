

{{--Salary Rule Basic Info--}}
<div class="col-md-6 col-sm-6">
    <div class="col-md-12 col-sm-12">
        <label class="col-form-label label-align" for="basic_salary">
            {{trans('app.basic_salary')}}
            {{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_basic_salary')}}"></i>--}}
        </label>
        <div class="item form-group">
            <input class="form-control" type="text" id="basic_salary" name="basic_salary" readonly value="@if($basic) {{$basic}} @endif">
        </div>
    </div>
</div>

@foreach($rule->salaryRuleStructure as $item)
    @php
        //dd($item);

       $amount = $item->amount;

       if ($item->is_percent)
       {
            $amount = ($amount / 100) * $basic;
       }

    @endphp

    <div class="col-md-6 col-sm-6">
        <div class="col-md-12 col-sm-12">
            <label class="col-form-label label-align" for="basic_salary">
                {{ $item->SalaryStructure->name }}
                {{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_basic_salary')}}"></i>--}}
            </label>
            <div class="item form-group">
                <input class="form-control" type="text" id="basic_salary" name="basic_salary" readonly value="{{ $amount }}">
            </div>
        </div>
    </div>

@endforeach

<div class="col-md-6 col-sm-6">
    <div class="col-md-12 col-sm-12">
        <label class="col-form-label label-align" for="tax">
          Tax
            {{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_tax')}}"></i>--}}
        </label>
        <div class="item form-group">
            <input class="form-control" type="text" id="tax" name="tax" readonly value="{{ $tax }}">
        </div>
    </div>
</div>
