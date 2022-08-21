<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{trans('app.employee_documents')}}</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                @if(has_permission('employee.document.add'))
                    <a class="btn btn-info ajax-modal-btn" href="javascript:void(0)"
                       data-link="{{route('employee.document.add', $employee->id)}}"><i
                            class="fa fa-plus"></i> {{trans('app.new_document')}}</a>
                @endif

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table class="table table-striped table-bordered no-footer dtr-inline w-100"
                  role="grid" aria-describedby="datatable-buttons_info">
                <thead>
                <tr>
                    <th>{{trans('app.index')}}</th>
                    <th>{{trans('app.name')}}</th>
                    <th>{{trans('app.document')}}</th>
                    <th class="action-buttons">{{trans('app.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employee->documents as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->doc_name}}</td>
                        <td>
                            @if(has_permission('employee.document.export'))
                                <a class="btn btn-warning" href="{{(get_file_url(optional($item)->path))}}"
                                   download><i class="fa fa-download"></i></a>
                            @endif
                            @if(has_permission('employee.document.delete'))
                                <a class="btn btn-danger" onclick="return confirm('are you sure?')"
                                   href="{{route('employee.document.delete', [$employee,$item])}}">
                                    <i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

