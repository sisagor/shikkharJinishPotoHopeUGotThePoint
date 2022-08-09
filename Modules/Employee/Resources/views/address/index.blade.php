<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{trans('app.employee_addresses')}}</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                @if(has_permission('addAddress'))
                    <a class="btn btn-info ajax-modal-btn" href="javascript:void(0)"
                       data-link="{{route('employee.address.add', $employee->id)}}">
                        <i class="fa fa-plus"></i> {{trans('app.new_address')}}</a>
                @endif
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table class="table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
                <thead>
                <tr>
                    <th>{{trans('app.index')}}</th>
                    <th>{{trans('app.type')}}</th>
                    <th>{{trans('app.city')}}</th>
                    <th>{{trans('app.state')}}</th>
                    <th>{{trans('app.address')}}</th>
                    <th>{{trans('app.country')}}</th>
                    <th class="action-buttons">{{trans('app.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employee->addresses as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->type}}</td>
                        <td>{{$item->city}}</td>
                        <td>{{$item->state}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->country->name}}</td>
                        <td>
                            @if(has_permission('editAddress'))
                                <a class="btn btn-warning ajax-modal-btn" href="javascript:void(0)"
                                   data-link="{{route('employee.address.edit', $item)}}">
                                    <i class="fa fa-pencil"></i></a>
                            @endif
                            @if(has_permission('deleteAddress'))
                                <a class="btn btn-danger" href="{{route('employee.address.delete', $item)}}"
                                   onclick="return confirm('are you sure?')">
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

