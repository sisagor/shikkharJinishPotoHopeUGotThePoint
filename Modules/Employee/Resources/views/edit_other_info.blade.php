<div class="form-body">
    <div class="row">

        <div class="col-md-9 col-sm-9 col-xs-12">

            {{-- ! Shows error without this informations --}}
            <input class="form-control" hidden type="text" id="name" name="name" required
                value="@if ($employee) {{ $employee->name }} @endif"
                placeholder="{{ trans('app.name') }}">

            <input class="form-control" hidden type="email" autocomplete="off" id="email" name="email" required
                value="@if ($employee) {{ $employee->email }} @endif"
                placeholder="{{ trans('app.email') }}">

            <input class="form-control" hidden type="text" id="phone" name="phone" required
                value="@if ($employee) {{ $employee->phone }} @endif"
                placeholder="{{ trans('app.phone') }}">
            {{-- ! Shows error without this informations --}}

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="professional_discipline">
                    {{ trans('app.professional_discipline') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="professional_discipline"
                        name="professional_discipline" required
                        value="@if ($employee) {{ $employee->professional_discipline }} @endif"
                        placeholder="{{ trans('app.professional_discipline') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="current_basic_pay">
                    {{ trans('app.current_basic_pay') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="current_basic_pay" name="current_basic_pay" required
                        value="@if ($employee) {{ $employee->current_basic_pay }} @endif"
                        placeholder="{{ trans('app.current_basic_pay') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="current_pay_scale_hold">
                    {{ trans('app.current_pay_scale_hold') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="current_pay_scale_hold" name="current_pay_scale_hold"
                        required
                        value="@if ($employee) {{ $employee->current_pay_scale_hold }} @endif"
                        placeholder="{{ trans('app.current_pay_scale_hold') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="health_service_joining_date">
                    {{ trans('app.health_service_joining_date') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" id="health_service_joining_date"
                        name="health_service_joining_date" required
                        value="@if ($employee) {{ $employee->health_service_joining_date }} @endif"
                        placeholder="{{ trans('app.health_service_joining_date') }}">
                </div>
            </div>


            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="current_place_joining_date">
                    {{ trans('app.current_place_joining_date') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" id="current_place_joining_date"
                        name="current_place_joining_date" required
                        value="@if ($employee) {{ $employee->current_place_joining_date }} @endif"
                        placeholder="{{ trans('app.current_place_joining_date') }}">
                </div>
            </div>


            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="current_designation_joining_date">
                    {{ trans('app.current_designation_joining_date') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" id="current_designation_joining_date"
                        name="current_designation_joining_date" required
                        value="@if ($employee) {{ $employee->current_designation_joining_date }} @endif"
                        placeholder="{{ trans('app.current_designation_joining_date') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="staff_professional_category">
                    {{ trans('app.staff_professional_category') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="staff_professional_category" name="staff_professional_category"
                        required>
                        <option value="Option 1" @if ($employee->staff_professional_category == 'Option 1') selected @endif>Option 1</option>
                        <option value="Option 2" @if ($employee->staff_professional_category == 'Option 2') selected @endif>Option 2</option>
                        <option value="Option 3" @if ($employee->staff_professional_category == 'Option 3') selected @endif>Option 3</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="job_status">
                    {{ trans('app.job_status') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="job_status" name="job_status" required>
                        <option value="Option 1" @if ($employee->job_status == 'Option 1') selected @endif>Option 1</option>
                        <option value="Option 2" @if ($employee->job_status == 'Option 2') selected @endif>Option 2</option>
                        <option value="Option 3" @if ($employee->job_status == 'Option 3') selected @endif>Option 3</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="tribe">
                    {{ trans('app.tribe') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="tribe" name="tribe"
                                value="1"@if ($employee->tribe) checked @endif>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="freedom_fighter">
                    {{ trans('app.freedom_fighter') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="freedom_fighter" name="freedom_fighter"
                                value="1"@if ($employee->freedom_fighter) checked @endif>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="lives_in_govt_quarter">
                    {{ trans('app.lives_in_govt_quarter') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="lives_in_govt_quarter" name="lives_in_govt_quarter"
                                value="1"@if ($employee->lives_in_govt_quarter) checked @endif>
                        </label>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
