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
                <label class="col-form-label label-align" for="last_promotion_information">
                    {{ trans('app.last_promotion_information') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="last_promotion_information"
                        name="last_promotion_information" required
                        value="@if ($employee) {{ $employee->last_promotion_information }} @endif"
                        placeholder="{{ trans('app.last_promotion_information') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="training_information">
                    {{ trans('app.training_information') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="training_information" name="training_information"
                        required value="@if ($employee) {{ $employee->training_information }} @endif"
                        placeholder="{{ trans('app.training_information') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="first_appointment_information">
                    {{ trans('app.first_appointment_information') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="first_appointment_information"
                        name="first_appointment_information" required
                        value="@if ($employee) {{ $employee->first_appointment_information }} @endif"
                        placeholder="{{ trans('app.first_appointment_information') }}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="bcs_psc_information">
                    {{ trans('app.bcs_psc_information') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="bcs_psc_information" name="bcs_psc_information"
                        required value="@if ($employee) {{ $employee->bcs_psc_information }} @endif"
                        placeholder="{{ trans('app.bcs_psc_information') }}">
                </div>
            </div>

            <div class="col-md-12 col-sm-6">
                <label class="col-form-label label-align" for="service_confirmation_information">
                    {{ trans('app.service_confirmation_information') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="service_confirmation_information"
                        name="service_confirmation_information" required
                        value="@if ($employee) {{ $employee->service_confirmation_information }} @endif"
                        placeholder="{{ trans('app.service_confirmation_information') }}">
                </div>
            </div>


            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="senior_scale_pass">
                    {{ trans('app.senior_scale_pass') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="senior_scale_pass" name="senior_scale_pass"
                                value="1"@if ($employee->senior_scale_pass) checked @endif>
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="experience_in_village">
                    {{ trans('app.experience_in_village') }}
                    <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="experience_in_village" name="experience_in_village"
                                value="1"@if ($employee->experience_in_village) checked @endif>
                        </label>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
