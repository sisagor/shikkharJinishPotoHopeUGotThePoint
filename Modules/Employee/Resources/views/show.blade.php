@extends('layouts.app')

{{--@section('styles')
    <link href="{{mix('css/datatable.css')}}" type="stylesheet"/>
@endsection--}}

@php
//dd(has_permission_url('employees'))
@endphp

@section('contents')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> {{ trans('app.module.'. session('module')) }}
                        <small>{{ trans('app.employee_details') }}</small></h2>
                    @if(! is_employee())
                        <ul class="nav navbar-right panel_toolbox">
                            {!! list_button('employee.employees.inactive', 'inactive_employees'). " " . list_button('employee.employees', 'employees') !!}
                        </ul>
                    @endif
                    <div class="clearfix"></div>
                </div>
               {{-- //Contents--}}
                <div class="x_content">
                    <ul  class="nav nav-tabs mb-2" id="myTab" role="tablist">
                        @if(has_permission('employee.employment.edit') && ! is_employee())
                            <li class="nav-item w-15">
                                <a class="nav-link active thin-tab" id="home-tab" data-toggle="tab" href="#employmentInformation"
                                   role="tab" aria-controls="home"
                                   aria-selected="true">{{trans('app.employment_information')}}</a>
                            </li>
                        @endif

                        @if(has_permission('employee.personal.edit'))
                            <li class="nav-item w-15">
                                <a class="nav-link @if(session('tab') == "personal") active @endif @if(is_employee()) active @endif thin-tab" id="profile-tab" data-toggle="tab" href="#personalInfo"
                                   role="tab"
                                   aria-controls="profile"
                                   aria-selected="false">{{trans('app.personal_information')}}</a>
                            </li>
                        @endif

                        <li class="nav-item w-15">
                            <a class="nav-link thin-tab" id="home-tab" data-toggle="tab" href="#LeaveAssign"
                               role="tab" aria-controls="home"
                               aria-selected="true">{{trans('app.leaves')}}</a>
                        </li>

                        @if(has_permission('employee.educations'))
                            <li class="nav-item w-15">
                                <a class="nav-link thin-tab" id="contact-tab" data-toggle="tab" href="#educationInfo" role="tab"
                                   aria-controls="contact"
                                   aria-selected="false">{{trans('app.educational_information')}}</a>
                            </li>
                        @endif
                        @if(has_permission('employee.addresses'))
                            <li class="nav-item w-15">
                                <a class="nav-link thin-tab" id="addresses-tab" data-toggle="tab" href="#addresses" role="tab"
                                   aria-controls="contact" aria-selected="false">{{trans('app.addresses')}}</a>
                            </li>
                        @endif
                        @if(has_permission('employee.documents'))
                            <li class="nav-item w-15">
                                <a class="nav-link thin-tab" id="contact-tab" data-toggle="tab" href="#document" role="tab"
                                   aria-controls="contact" aria-selected="false">{{trans('app.documents')}}</a>
                            </li>
                        @endif
                    </ul >

                    {{-- Tab Contents --}}

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade @if(session('tab') == "employment") show active @endif" id="employmentInformation" role="tabpanel"
                                 aria-labelledby="employmentInformation-tab">
                                @if(has_permission('employee.employment.edit') && ! is_employee())
                                    <form method="post" enctype="multipart/form-data"
                                          action="{{route('employee.employment.update', $employee->id)}}?employmentInfo">
                                        @csrf

                                        @include('employee::edit_employment_info')

                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-5 mt-2">
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                            name="submit"
                                                            value="1" class="btn btn-primary">{{trans('app.update')}}
                                                    </button>
                                                    <button type="reset" id="resetButton" class="btn btn-secondary">Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                            {{--End Employment inforrmation --}}


                            {{--Personal Information--}}
                            <div class="tab-pane fade @if(session('tab') == "personal") show active @endif" id="personalInfo" role="tabpanel"
                                 aria-labelledby="personalInfo-tab">
                                @if(has_permission('employee.personal.edit'))
                                    <form method="post" enctype="multipart/form-data"
                                          action="{{route('employee.personal.update', $employee->id)}}">
                                        @csrf

                                        @include('employee::edit_personal_info')

                                        <div class="ln_solid">
                                            <div class="form-group">
                                                <div class="col-md-6 offset-md-5 mt-2">
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                            name="submit"
                                                            value="1" class="btn btn-primary"> {{trans('app.update')}}
                                                    </button>
                                                    <button type="reset" id="resetButton" class="btn btn-secondary">Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                            {{--End Personal Information--}}

                            {{--Start Leave assign--}}
                            <div class="tab-pane fade" id="LeaveAssign" role="tabpanel" aria-labelledby="LeaveAssign-tab">
                                @include('employee::leave.index')
                            </div>
                            {{--End Leave assign--}}

                            {{--Educational Information--}}
                            <div class="tab-pane fade" id="educationInfo" role="tabpanel" aria-labelledby="educationInfo-tab">
                                @if(has_permission('employee.addresses'))
                                    @include('employee::education.index')
                                @endif
                            </div>
                            {{-- End Educational Information--}}

                            {{--Aaddresses--}}
                            <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                                @if(has_permission('employee.educations'))
                                    @include('employee::address.index')
                                @endif
                            </div>
                            {{--End Documents--}}

                            {{--Documents--}}
                            <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                                @if(has_permission('employee.documents'))
                                    @include('employee::document.index')
                                @endif
                            </div>
                            {{--End Documents--}}
                        </div>
                    {{--End Form content--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
   {{-- <script src="{{mix('js/datatable.js')}}"></script>--}}
    @include('employee::scripts.employee')
    @include('employee::scripts.leave')
   {{-- @include('employee::scripts.education')--}}

    @if(is_employee())
        <script>
            $('#employees').addClass('hide');
        </script>
    @endif

@endsection



