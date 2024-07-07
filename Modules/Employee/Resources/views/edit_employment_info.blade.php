<div class="form-body">
    <div class="row">
        {{--Employemnt Info--}}
        <div class="col-md-6 col-sm-6">
            <label class="col-form-label label-align" for="employee_index">
                {{trans('app.employee_id')}} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                   title="{{ trans('help.employee_id')}}"></i>
            </label>
            <div class="item form-group">
                <input class="form-control" readonly value="{{$employee->employee_index}}">
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-12">
            <div class="row">
                <div class="col-md-11 col-sm-6 col-11">
                    <label class="col-form-label label-align" for="parent_id">
                        {{trans('app.department')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.department')}}"></i>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" data-link="{{route('organization.designation.get')}}"
                                data-child-id="designation_id" id="parent_id" name="department_id" required>
                            <option value="">{{trans('app.select')}}</option>
                            @foreach(get_departments() as $id => $name)
                                <option value="{{ $id }}"
                                        @if($employee->department_id == $id) selected @endif >{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-1">
                    <div class="item form-group plus_button">
                        <a href="javascript:void(0)" data-link="{{ route('organization.department.add') }}" class="ajax-modal-btn btn btn-info">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-12">
            <div class="row">
                <div class="col-md-11 col-sm-11 col-11">
                    <label class="col-form-label label-align" for="designation_id">
                        {{trans('app.designation')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.designation')}}"></i>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" id="designation_id" name="designation_id" required>
                            @if(! empty($employee->designation))
                                <option value="{{$employee->designation_id}}">{{$employee->designation->name}}</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-1">
                    <div class="item form-group plus_button">
                        <a href="javascript:void(0)" data-link="{{ route('organization.designation.add') }}" class="ajax-modal-btn btn btn-info">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-12">
            <div class="row">
                <div class="col-md-11 col-sm-11 col-11">
                    <label class="col-form-label label-align" for="shift_id">
                        {{trans('app.shift')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.shift')}}"></i>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" id="shift_id" name="shift_id" required>
                            <option value="">{{trans('app.select')}}</option>
                            @foreach(get_shifts() as $id => $shift)
                                <option value="{{$id}}"
                                        @if($employee->shift_id == $id) selected @endif >{{ $shift }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-1 col-sm-1 col-1">
                    <div class="item form-group plus_button">
                        <a href="javascript:void(0)" data-link="{{ route('componentSettings.shift.add') }}" class="ajax-modal-btn btn btn-info">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-12">
            <div class="row">
                <div class="col-md-11 col-sm-11 col-11">
                    <label class="col-form-label label-align" for="type_id">
                        {{trans('app.employee_type')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.employee_type')}}"></i>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" id="type_id" name="type_id" required>
                            <option value="">{{trans('app.select')}}</option>
                            @foreach(get_employee_types() as $id => $type)
                                <option value="{{$id}}"
                                        @if($employee->type_id == $id) selected @endif>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-1 col-sm-1 col-1">
                    <div class="item form-group plus_button">
                        <a href="javascript:void(0)" data-link="{{ route('componentSettings.employmentType.add') }}" class="ajax-modal-btn btn btn-info">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{--provision--}}
        @if(config('company_settings.has_provision_period'))
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="provision_period">
                    {{trans('app.provision_period')}} (in month)<span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.employee_provision_period')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" id="provision_period" name="provision_period"
                           value="@if(($employee->provision_period)){{$employee->provision_period}}@else{{0}}@endif"/>
                </div>
            </div>
        @endif

        {{--Provident maturity date--}}
        {{--  @if(config('company_settings.has_provident_fund'))
              <div class="col-md-6 col-sm-6">
                  <label class="col-form-label label-align" for="provident_maturity_date">
                      {{trans('app.provident_maturity_date')}}<span class="required">*</span>
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                         title="{{ trans('help.provident_maturity_date')}}"></i>
                  </label>
                  <div class="item form-group">
                      <input class="form-control datePicker" id="provident_maturity_date" name="provident_maturity_date"
                             value="{{$employee->provident_maturity_date}}"/>
                  </div>
              </div>
          @endif--}}

        {{--Provident maturity date--}}
        {{--  @if(config('company_settings.has_insurance'))
              <div class="col-md-6 col-sm-6">
                  <label class="col-form-label label-align" for="insurance_maturity_date">
                      {{trans('app.insurance_maturity_date')}}<span class="required">*</span>
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                         title="{{ trans('help.insurance_maturity_date')}}"></i>
                  </label>
                  <div class="item form-group">
                      <input class="form-control datePicker" id="insurance_maturity_date" name="insurance_maturity_date"
                             value="{{$employee->insurance_maturity_date}}"/>
                  </div>
              </div>
          @endif--}}

        {{--Ovettime--}}
        @if(config('company_settings.allow_overtime'))

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="allow_overtime">
                    {{trans('app.allow_overtime')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.allow_overtime')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="allow_overtime" id="allow_overtime">
                        <option value="{{\Modules\Employee\Entities\Employee::OVERTIME_ALLOW}}"
                                @if($employee->allow_overtime == \Modules\Employee\Entities\Employee::OVERTIME_ALLOW) selected @endif>
                            {{trans('app.yes')}} </option>
                        <option value="{{\Modules\Employee\Entities\Employee::OVERTIME_NOT_ALLOW}}"
                                @if($employee->allow_overtime == \Modules\Employee\Entities\Employee::OVERTIME_NOT_ALLOW) selected
                            @endif>
                            {{trans('app.no')}} </option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="col-md-10">
                    <label class="col-form-label label-align" for="overtime_allowance">
                        {{trans('app.overtime_allowance')}} (per hour rate)
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.overtime_allowance')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="form-control" type="text" id="overtime_allowance" name="overtime_allowance"
                               value="{{$employee->overtime_allowance}}"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="col-form-label label-align" for="allowance_percent">
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.is_percent')}}"></i>
                    </label>
                    <div class="item form-group">
                        <input class="checkbox" type="checkbox" value="1" id="allowance_percent" name="allowance_percent"
                               @if($employee->allowance_percent == 1) checked @endif/>
                    </div>
                </div>
            </div>
        @endif

        {{--provision--}}
        <div class="col-md-6 col-sm-6">
            <div class="row">
                <div class="col-md-11 col-sm-11">
                    <label class="col-form-label label-align" for="leave_policy">
                        {{trans('app.leave_policy')}} <span class="required">*</span>
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                           title="{{ trans('help.leave_policy')}}"></i>
                    </label>
                    <div class="item form-group">
                        <select class="form-control" id="leave_policy" name="leave_policy_id" required>
                            <option value="">{{trans('app.select')}}</option>
                            @foreach(get_leave_policies() as $key => $item)
                                <option value="{{ $key }}" @if($employee->leave_policy_id == $key) selected @endif>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-1 col-sm-1 col-1">
                    <div class="item form-group plus_button">
                        <a href="javascript:void(0)" data-link="{{ route('organization.leavePolicy.add') }}" class="ajax-modal-btn btn btn-info">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <label class="col-form-label label-align" for="basic_salary">
                {{trans('app.basic_salary')}}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                   title="{{ trans('help.employee_basic_salary')}}"></i>
            </label>
            <div class="item form-group">
                <input class="form-control" type="number" step="*" id="basic_salary" name="basic_salary"
                       value="{{round($employee->basic_salary, 2)}}"/>
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <label class="col-form-label label-align" for="joining_date">
                {{trans('app.joining_date')}} <span class="required">*</span>
            </label>
            <div class="item form-group">
                <input type="text" class="form-control datePicker" id="joining_date" name="joining_date" required
                       value="{{$employee->joining_date}}" autocomplete="off"
                       placeholder="{{trans('app.joining_date')}}">
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <label class="col-form-label label-align" for="card_no">
                {{trans('app.card_no')}}
            </label>
            <div class="item form-group">
                <input class="form-control" id="card_no" name="card_no"
                       placeholder="{{trans('app.card_no')}}">
            </div>
        </div>

        {{--Status--}}
        <div class="col-md-6 col-sm-6">
            <label class="col-form-label label-align" for="status">
                {{trans('app.device_id')}}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                   title="{{ trans('help.device_id')}}"></i>
            </label>
            <div class="item form-group">
                <input class="form-control" id="device_id" name="device_id"
                       value="{{$employee->device_id}}" placeholder="{{trans('app.device_id')}}">
            </div>
        </div>

        {{--Status--}}
        <div class="col-md-6 col-sm-6">
            <label class="col-form-label label-align" for="status">
                {{trans('app.status')}} <span class="required">*</span>
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                   title="{{ trans('help.status')}}"></i>
            </label>
            <div class="item form-group">
                <select class="form-control" name="status" id="status">
                    <option value="{{\App\Models\RootModel::STATUS_ACTIVE}}"
                            @if($employee->status ==\App\Models\RootModel::STATUS_ACTIVE) selected @endif>
                        {{trans('app.active')}} </option>
                    <option value="{{\App\Models\RootModel::STATUS_INACTIVE}}"
                            @if($employee->status == \App\Models\RootModel::STATUS_INACTIVE) selected @endif>
                        {{trans('app.inactive')}} </option>
                </select>
            </div>
        </div>

        @if($employee->user)
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="role_id">
                    {{trans('app.access_role')}}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.access_role')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control select2-dropdown" id="role_id" name="role_id">
                        <option value="">{{trans('app.select')}}</option>
                        @foreach(get_roles(\App\Models\Role::ROLE_EMPLOYEE) as $id => $name)
                            <option value="{{ $id }}"
                                    @if($employee->user->role_id == $id) selected @endif>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{--access Level--}}
            {{--<div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="level">
                    {{trans('app.access_level')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.access_level')}}"></i>
                </label>
                <div class="item form-group">
                    <select class="form-control" name="level" id="level">
                        @foreach(config('user.user_levels') as $level)
                            <option value="{{$level['value']}}"
                                     @if($employee->user->level == $level['value']) selected @endif>
                                {{ $level['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>--}}
        @endif
    </div>
</div>

