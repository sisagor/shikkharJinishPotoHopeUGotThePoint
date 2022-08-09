@if(count(get_salary_rule_structure_components(\Modules\Payroll\Entities\SalaryStructure::TYPE_PROVIDENT)))

    <fieldset class="mt-3">
        <legend>{{ trans('app.provident_fund') }}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_structure_deduct')}}"></i>
        </legend>

        @foreach(get_salary_rule_structure_components(\Modules\Payroll\Entities\SalaryStructure::TYPE_PROVIDENT) as $id => $provident)
            @php
                $oldProvident =  $oldAdd = (! empty($rule) ? get_salary_rule_structure_component_by_id($rule->id, $id) : null);
            @endphp

            <div class="col-md-12 col-sm-12">
                <div class="col-md-8">
                    <label class="col-form-label label-align" for="{{ $provident }}">
                        {{ $provident }}
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="number" step=".01" id="{{ $provident }}" name="provident_type[{{$id}}]" placeholder="00.00"
                               value="@if(! empty($oldProvident)){{(float)$oldProvident->amount}}@endif"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="col-form-label label-align" for="is_percent">
                        {{ trans('app.is_percent') }}
                    </label>
                    <div class="item form-group ml-3">
                        <input class="checkbox " type="checkbox" @if(! empty($oldProvident)) @if($oldProvident->is_percent) checked
                               @endif @endif id="is_percent" name="provident_percent[{{$id}}]" value="1"/>
                    </div>
                </div>

            </div>

        @endforeach

    </fieldset>

@endif
