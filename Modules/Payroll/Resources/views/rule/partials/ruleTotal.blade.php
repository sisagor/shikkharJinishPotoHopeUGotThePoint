@php
    //dd($item);

   $gross = $basic;


@endphp

@foreach($rule->salaryRuleStructure as $item)
    @php
        //dd($item);

       $amount = $item->amount;

       if ($item->is_percent)
       {
            $amount = ($amount / 100) * $basic;
       }

       $gross += $amount;

    @endphp
@endforeach

<div class="col-md-4 col-sm-4">
    <label class="col-form-label label-align" for="gross_salary" style="color: #0f0f0f">
        {{ trans('app.gross_salary') }}
        {{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_gross_salary')}}"></i>--}}
    </label>
    <div class="item form-group">
        <input class="form-control" type="text" id="gross_salary" name="gross_salary" readonly value="{{ $gross }}">
    </div>
</div>

<div class="col-md-4 col-sm-4">
    <label class="col-form-label label-align" for="net_salary" style="color: #0f0f0f">
        {{ trans('app.net_salary') }}
        {{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_tax')}}"></i>--}}
    </label>
    <div class="item form-group">
        <input class="form-control" type="text" id="net_salary" name="net_salary" readonly value="@if(is_numeric($tax)){{ ($gross - $tax) }}@else 0 @endif">
    </div>
</div>

<div class="col-md-4 col-sm-4">
    <label class="col-form-label label-align" for="payable_salary" style="color: #0f0f0f">
        {{ trans('app.payable_salary') }}
        {{-- <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_rule_tax')}}"></i>--}}
    </label>
    <div class="item form-group">
        <input class="form-control" type="text" id="payable_salary" name="payable_salary" readonly value="@if(is_numeric($tax)){{ ($gross - $tax) }}@else {{ $gross }} @endif">
    </div>
</div>
