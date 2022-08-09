@if(count(get_salary_rule_structure_components(\Modules\Payroll\Entities\SalaryStructure::TYPE_INSURANCE)))

    <fieldset class="mt-3">
        <legend>{{ trans('app.insurance_installation') }}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_structure_deduct')}}"></i>
        </legend>

        @foreach(get_salary_rule_structure_components(\Modules\Payroll\Entities\SalaryStructure::TYPE_INSURANCE) as $id => $insurance)
            @php
                $oldInsurance =  $oldAdd = (! empty($rule) ? get_salary_rule_structure_component_by_id($rule->id, $id) : null);
            @endphp
            <div class="col-md-12 col-sm-12">
                <div class="col-md-8">
                    <label class="col-form-label label-align" for="{{ $insurance }}">
                        {{ $insurance }}
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="number" step=".01" id="{{ $insurance }}" name="insurance_type[{{$id}}]" placeholder="00.00"
                               value="@if(!empty($oldInsurance)){{(float)$oldInsurance->amount}}@endif"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label label-align" for="is_percent">
                        {{ trans('app.is_percent') }}
                    </label>
                    <div class="item form-group ml-3">
                        <input class="checkbox " type="checkbox" @if(!empty($oldInsurance))@if($oldInsurance->is_percent) checked
                               @endif @endif id="is_percent" name="insurance_percent[{{$id}}]" value="1"/>
                    </div>
                </div>

            </div>

        @endforeach

    </fieldset>

@endif
