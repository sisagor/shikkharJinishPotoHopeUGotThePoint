<div class="form-body">
    <div class="row">
        {{-- Profile Info --}}
        <div class="col-md-3 col-sm-3  profile_left">
            <div class="profile_img">
                <div id="crop-avatar">
                    <!-- Current avatar -->
                    <img class="img-responsive profile_img"
                        src="{{ get_storage_file_url(optional($employee->profile)->path, 'profile') }}"
                        alt="{{ trans('app.employee_image') }}" title="{{ trans('app.employee_image') }}">
                    <input type="file" name="image">

                </div>
            </div>
        </div>

        <div class="col-md-9 col-sm-9 col-xs-12">
            {{-- Personal Info --}}
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="name">
                    {{ trans('app.name') }} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="name" name="name" required
                        value="@if ($employee) {{ $employee->name }} @endif"
                        placeholder="{{ trans('app.name') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="email">
                    {{ trans('app.email') }} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                        title="{{ trans('help.email') }}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="email" autocomplete="off" id="email" name="email" required
                        value="@if ($employee) {{ $employee->email }} @endif"
                        placeholder="{{ trans('app.email') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="phone">
                    {{ trans('app.phone') }} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="phone" name="phone" required
                        value="@if ($employee) {{ $employee->phone }} @endif"
                        placeholder="{{ trans('app.phone') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="dob">
                    {{ trans('app.dob') }} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" id="dob" name="dob" required
                        value="@if ($employee) {{ $employee->dob }} @endif"
                        placeholder="{{ trans('app.dob') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="gender">
                    {{ trans('app.gender') }} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male" @if ($employee->gender == 'Male') selected @endif>
                            {{ trans('app.male') }}</option>
                        <option value="Female" @if ($employee->gender == 'Female') selected @endif>
                            {{ trans('app.female') }}</option>
                        <option value="Others" @if ($employee->gender == 'Others') selected @endif>
                            {{ trans('app.others') }}</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="marital_status">
                    {{ trans('app.marital_status') }} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="marital_status" name="marital_status" required>
                        <option value="Single" @if ($employee->marital_status == 'Single') selected @endif>
                            {{ trans('app.single') }}</option>
                        <option value="Married" @if ($employee->marital_status == 'Married') selected @endif>
                            {{ trans('app.married') }}</option>
                        <option value="Widowed" @if ($employee->marital_status == 'Widowed') selected @endif>
                            {{ trans('app.widowed') }}</option>
                    </select>
                </div>
            </div>

            {{-- * My work From here --}}

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="fathers_name">
                    {{ trans('app.fathers_name') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="fathers_name" name="fathers_name" required
                        value="@if ($employee) {{ $employee->fathers_name }} @endif"
                        placeholder="{{ trans('app.fathers_name') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="mothers_name">
                    {{ trans('app.mothers_name') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="mothers_name" name="mothers_name" required
                        value="@if ($employee) {{ $employee->mothers_name }} @endif"
                        placeholder="{{ trans('app.mothers_name') }}">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="present_address">
                    {{ trans('app.present_address') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="present_address" name="present_address" required
                        value="@if ($employee) {{ $employee->present_address }} @endif"
                        placeholder="{{ trans('app.present_address') }}">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <label class="col-form-label label-align" for="parmanent_address">
                    {{ trans('app.parmanent_address') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="parmanent_address" name="parmanent_address"
                        required value="@if ($employee) {{ $employee->parmanent_address }} @endif"
                        placeholder="{{ trans('app.parmanent_address') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="nid">
                    {{ trans('app.nid') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="nid" name="nid" required
                        value="@if ($employee) {{ $employee->nid }} @endif"
                        placeholder="{{ trans('app.nid') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="religion">
                    {{ trans('app.religion') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="religion" name="religion" required
                        value="@if ($employee) {{ $employee->religion }} @endif"
                        placeholder="{{ trans('app.religion') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="prl_date">
                    {{ trans('app.prl_date') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" id="prl_date" name="prl_date" required
                        value="@if ($employee) {{ $employee->prl_date }} @endif"
                        placeholder="{{ trans('app.prl_date') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="status">
                    {{ trans('app.status') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="status" name="status" required
                        value="@if ($employee) {{ $employee->status }} @endif"
                        placeholder="{{ trans('app.status') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="posted_as">
                    {{ trans('app.posted_as') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="posted_as" name="posted_as" required
                        value="@if ($employee) {{ $employee->posted_as }} @endif"
                        placeholder="{{ trans('app.posted_as') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="joining_back_verified">
                    {{ trans('app.joining_back_verified') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="joining_back_verified"
                        name="joining_back_verified" required
                        value="@if ($employee) {{ $employee->joining_back_verified }} @endif"
                        placeholder="{{ trans('app.joining_back_verified') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="hris_id">
                    {{ trans('app.hris_id') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="hris_id" name="hris_id" required
                        value="@if ($employee) {{ $employee->hris_id }} @endif"
                        placeholder="{{ trans('app.hris_id') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="post_id">
                    {{ trans('app.post_id') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="post_id" name="post_id" required
                        value="@if ($employee) {{ $employee->post_id }} @endif"
                        placeholder="{{ trans('app.post_id') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="bcs_batch_no">
                    {{ trans('app.bcs_batch_no') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="bcs_batch_no" name="bcs_batch_no" required
                        value="@if ($employee) {{ $employee->bcs_batch_no }} @endif"
                        placeholder="{{ trans('app.bcs_batch_no') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="code_no">
                    {{ trans('app.code_no') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="code_no" name="code_no" required
                        value="@if ($employee) {{ $employee->code_no }} @endif"
                        placeholder="{{ trans('app.code_no') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="study_deputation_number">
                    {{ trans('app.study_deputation_number') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="study_deputation_number"
                        name="study_deputation_number" required
                        value="@if ($employee) {{ $employee->study_deputation_number }} @endif"
                        placeholder="{{ trans('app.study_deputation_number') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="original_designation">
                    {{ trans('app.original_designation') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="original_designation" name="original_designation"
                        required
                        value="@if ($employee) {{ $employee->original_designation }} @endif"
                        placeholder="{{ trans('app.original_designation') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="acr_availability">
                    {{ trans('app.acr_availability') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="acr_availability" name="acr_availability"
                        required value="@if ($employee) {{ $employee->acr_availability }} @endif"
                        placeholder="{{ trans('app.acr_availability') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="educational_qualification">
                    {{ trans('app.educational_qualification') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="educational_qualification"
                        name="educational_qualification" required
                        value="@if ($employee) {{ $employee->educational_qualification }} @endif"
                        placeholder="{{ trans('app.educational_qualification') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="actual_degree">
                    {{ trans('app.actual_degree') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="actual_degree" name="actual_degree" required
                        value="@if ($employee) {{ $employee->actual_degree }} @endif"
                        placeholder="{{ trans('app.actual_degree') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="educational_discipline">
                    {{ trans('app.educational_discipline') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="educational_discipline"
                        name="educational_discipline" required
                        value="@if ($employee) {{ $employee->educational_discipline }} @endif"
                        placeholder="{{ trans('app.educational_discipline') }}">
                </div>
            </div>

        </div>

    </div>
</div>
