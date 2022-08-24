<div class="form-body">
    <div class="row">
        {{--Profile Info--}}
        <div class="col-md-3 col-sm-3  profile_left">
            <div class="profile_img">
                <div id="crop-avatar">
                    <!-- Current avatar -->
                    <img class="img-responsive profile_img"
                         src="{{ get_storage_file_url(optional($employee->profile)->path, 'profile') }}"
                         alt="{{trans('app.employee_image')}}" title="{{trans('app.employee_image')}}">
                    <input type="file" name="image">

                </div>
            </div>
        </div>

        <div class="col-md-9 col-sm-9 col-xs-12">
            {{--Personal Info--}}
            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="name">
                    {{trans('app.name')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="name" name="name" required
                           value="@if($employee){{$employee->name}}@endif"
                           placeholder="{{trans('app.name')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="email">
                    {{trans('app.email')}} <span class="required">*</span>
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                       title="{{ trans('help.email')}}"></i>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="email" autocomplete="off" id="email" name="email" required
                           value="@if($employee){{$employee->email}}@endif" placeholder="{{trans('app.email')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="phone">
                    {{trans('app.phone')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control" type="text" id="phone" name="phone" required
                           value="@if($employee){{$employee->phone}}@endif" placeholder="{{trans('app.phone')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="dob">
                    {{trans('app.dob')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <input class="form-control datePicker" id="dob" name="dob" required
                           value="@if($employee){{$employee->dob}}@endif" placeholder="{{trans('app.dob')}}">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="gender">
                    {{trans('app.gender')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="Male"
                                @if($employee->gender == "Male") selected @endif >{{trans('app.male')}}</option>
                        <option value="Female"
                                @if($employee->gender == "Female") selected @endif >{{trans('app.female')}}</option>
                        <option value="Others"
                                @if($employee->gender == "Others") selected @endif>{{trans('app.others')}}</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <label class="col-form-label label-align" for="marital_status">
                    {{trans('app.marital_status')}} <span class="required">*</span>
                </label>
                <div class="item form-group">
                    <select class="form-control" id="marital_status" name="marital_status" required>
                        <option value="Single"
                                @if($employee->marital_status == "Single") selected @endif >{{trans('app.single')}}</option>
                        <option value="Married"
                                @if($employee->marital_status == "Married") selected @endif >{{trans('app.married')}}</option>
                        <option value="Widowed"
                                @if($employee->marital_status == "Widowed") selected @endif>{{trans('app.widowed')}}</option>
                    </select>
                </div>
            </div>

        </div>

    </div>
</div>

