@extends('layouts.app')

@section('styles')
    <link href="{{mix('css/datatable.css')}}" rel="stylesheet">
@endsection

@section('contents')
    {{--
     you have to pass this 2 parramitter when you call this layout
     Table Title $title
     action button type $btnType
     Table contents
     --}}
    <div class="row">
        {{--Filter section--}}
        @if(! empty($filter))
            <div class="filter-box mb-2">
                <div class="col-md-1">
                    <strong class="font25">{{trans('app.filter')}}</strong>
                </div>
                <div class="col-md-11">

                    @if($filter == 1)
                        @if(is_admin_group())
                            <div class="col-md-5 col-sm-5 col-12">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <select class="form-control" name="company" id="company-filter">
                                        <option value="">{{trans('app.select_company')}}</option>
                                        @foreach(get_companies() as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-6 col-12">
                                    <select class="form-control" name="branch" id="branch-filter">
                                        <option value="">{{trans('app.select_branch')}}</option>
                                        @foreach(get_branches() as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @if(is_company_group() || is_department_admin())
                            <div class="col-md-3 col-sm-3 col-12">
                                {{-- <label class="col-md-5 col-form-label label-align" for="employee_index">
                                     {{trans('app.branch')}}
                                     <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                                        title="{{ trans('help.select_branch')}}"></i>
                                 </label>--}}
                                <select class="form-control" name="branch" id="branch-filter">
                                    <option value="">{{trans('app.select_branch')}}</option>
                                    @foreach(get_branches() as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @endif

                    @yield('filter')

                </div>
            </div>
        @endif
        {{--End Filter Section--}}

        {{-- Table section--}}

        @yield('reports')
    </div>



    {{-- End Table section--}}

@endsection

@section('scripts')
    <!-- Datatables -->
    <script src="{{mix('js/datatable.js')}}"></script>
    @yield('reportsScript')
@endsection


