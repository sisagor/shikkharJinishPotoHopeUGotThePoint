@if(count(get_salary_rule_structure_components(\Modules\Payroll\Entities\SalaryStructure::TYPE_DEDUCT)) > 0)

    <div class="col-md-4 col-sm-4">
        <fieldset>
            <legend>{{ trans('app.deduct_from_salary') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_structure_deduct')}}"></i>
            </legend>

            @foreach(get_salary_rule_structure_components(\Modules\Payroll\Entities\SalaryStructure::TYPE_DEDUCT) as $id => $deduct)
                @php
                    $oldDeduct =  $oldAdd = (! empty($rule) ? get_salary_rule_structure_component_by_id($rule->id, $id) : null);
                @endphp
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-8">
                        <label class="col-form-label label-align" for="{{ $deduct }}">
                            {{ $deduct }}
                        </label>
                        <div class="item form-group">
                            <input class="form-control" type="number" step=".01" id="{{ $deduct }}" name="deduct_type[{{$id}}]" placeholder="00.00"
                                   value="@if(! empty($oldDeduct)){{(float)$oldDeduct->amount}}@endif"/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="col-form-label label-align" for="is_percent">
                            {{ trans('app.is_percent') }}
                        </label>
                        <div class="item form-group ml-3">
                            <input class="checkbox " type="checkbox" @if(! empty($oldDeduct)) @if($oldDeduct->is_percent) checked
                                   @endif @endif id="is_percent" name="deduct_percent[{{$id}}]" value="1"/>
                        </div>
                    </div>

                </div>

            @endforeach

        </fieldset>

        {{--Salary Rule structure components type Deduct--}}
        {{-- @include('payroll::rule.partials.providentTypeComponents')--}}


        {{--Salary Rule structure components type Deduct--}}
        {{-- @include('payroll::rule.partials.insuranceTypeComponents')--}}


    </div>

@endif
