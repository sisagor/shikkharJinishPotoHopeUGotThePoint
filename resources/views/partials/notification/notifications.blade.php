@extends('layouts.app')

@section('contents')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ trans('app.notifications') }}
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <div class="clearfix"></div>
                    <li class="dropdown">
                        {{-- {!! add_button($btnType ?? null) !!}--}}
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                {{-- <th>
                                     <input type="checkbox" id="check-all" value="1" name="messDelete" class="flat">
                                 </th>--}}
                                <th class="column-title">#</th>
                                <th class="column-title">{{trans('app.name')}}</th>
                                <th class="column-title">{{trans('app.information')}}</th>
                                <th class="column-title">{{trans('app.created_at')}}</th>
                                <th class="column-title no-link last"><span class="nobr">{{trans('app.action')}}</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($notifications as $key => $item)

                                @php
                                    //var_dump($item->unread());
                                @endphp

                                <tr class="odd pointer mark-as-read-{{$item->id}} @if($item->unread()) unread-notification-back @endif">
                                    {{-- <td class="a-center ">
                                         <input type="checkbox" class="flat" name="row[]" value="1">
                                     </td>--}}
                                    <td class=" ">{{ (($notifications->currentPage() * 10) - 10) + $loop->iteration }}</td>
                                    <td>{{$item->data['name']}}</td>
                                    <td>{{$item->data['activity']}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>

                                    <td class="last">

                                        <div class="@if($item->unread()) show @else hide @endif mark_as_read_button_{{$item->id}}">
                                            <a class="btn btn-dark"
                                               href="javascript:void(0)"
                                               onclick="markAsRead('{{$item->id}}')">
                                                {{trans('app.mark_as_read')}}
                                            </a>
                                        </div>
                                        <div class="@if($item->read()) show @else hide @endif marked_as_read_button_{{$item->id}}">
                                            <button class="btn btn-active">
                                                {{trans('app.marked_as_read')}}
                                            </button>
                                        </div>

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content">
                            {!! $notifications->links() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
