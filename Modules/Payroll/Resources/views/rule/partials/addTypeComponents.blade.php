@if(count(get_salary_rule_structure_components(\Modules\Payroll\Entities\SalaryStructure::TYPE_ADD)) > 0)

    <div class="col-md-4 col-sm-4">
        <fieldset>
            <legend>{{ trans('app.add_with_salary') }}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.salary_structure_add')}}"></i>
            </legend>

            @foreach(get_salary_rule_structure_components(\Modules\Payroll\Entities\SalaryStructure::TYPE_ADD) as $id => $add)
                @php
                    $oldAdd = (! empty($rule) ? get_salary_rule_structure_component_by_id($rule->id, $id) : null);
                @endphp
                <div class="col-md-12 col-sm-12">
                    <div class="col-md-8">
                        <label class="col-form-label label-align" for="{{ $add }}">
                            {{ $add }}
                        </label>
                        <div class="item form-group">
                            <input class="form-control" type="number" step=".01" id="{{ $add }}" name="add_type[{{$id}}]" placeholder="00.00"
                                   value="@if(! empty($oldAdd)){{(float)$oldAdd->amount}}@endif"/>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="col-form-label label-align" for="is_percent">
                            {{ trans('app.is_percent') }}
                        </label>
                        <div class="item form-group ml-3">
                            <input class="checkbox " type="checkbox" @if(! empty($oldAdd))@if($oldAdd->is_percent) checked
                                   @endif @endif id="is_percent" name="add_percent[{{$id}}]" value="1"/>
                        </div>
                    </div>
                </div>
            @endforeach
        </fieldset>

        @include('payroll::rule.partials.overtimeTypeComponents')

    </div>
@endif
