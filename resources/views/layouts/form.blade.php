@extends('layouts.app')
@section('contents')
    @if (!empty(session('action')))
        {{-- $title --}}
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> {{ trans('app.module.'. session('module')) }}
                            <small>{{ trans('app.'.session('actionTitle')) }}</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li>
                                {!! list_button() !!}
                            </li>
                            {{--  <li><a class="close-link"><i class="fa fa-close"></i></a>
                              </li>--}}
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form method="post" enctype="multipart/form-data"
                              action="{{ (!empty(session('actionId')) ? route(session('action'), session('actionId')) : route(session('action')))}}">
                            @csrf
                            <div class="clearfix"></div>

                            {{--Form content--}}
                            @yield('form')
                            {{--End Form content--}}

                            <div class="clearfix"></div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-5 form-padding">
                                        <button type="submit" onclick="return confirm('Are you sure?')" name="submit"
                                                value="1" class="btn btn-primary">
                                            @if(!empty(session('actionId'))) {{session('actionBtn') ?? trans('app.update')}} @else {{session('actionBtn') ?? trans('app.save')}} @endif
                                        </button>
                                        <button type="reset" id="resetButton" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    @else

        <div class="row d-inline-block">
            <div class="col-md-12">
                <div class="col-middle">
                    <div class="text-center text-center">
                        <h1 class="error-number">404</h1>
                        <h2>Action Route missing</h2>
                        <p class="text-warning">
                            Set your action route from controller
                        </p>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection

@section('scripts')
    @yield('formScripts')
@endsection
@php
    session(['action' => null, 'actionId' => null, 'actionTitle' => null, 'actionBtn' => null])
@endphp
