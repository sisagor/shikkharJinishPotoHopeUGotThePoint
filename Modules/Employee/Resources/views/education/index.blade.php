<div class="col-md-12 col-sm-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>{{trans('app.employee_educations')}}</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                @if(has_permission('addEducation'))
                    <a class="btn btn-info ajax-modal-btn" href="javascript:void(0)"
                       data-link="{{route('employee.education.add', $employee)}}"><i
                            class="fa fa-plus"></i> {{trans('app.new_education')}}</a>
                @endif
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table class="table table-striped table-bordered no-footer dtr-inline w-100" role="grid" aria-describedby="datatable-buttons_info">
                <thead>
                <tr>
                    <th>{{trans('app.index')}}</th>
                    <th>{{trans('app.exam_title')}}</th>
                    <th>{{trans('app.institute_name')}}</th>
                    <th>{{trans('app.passing_year')}}</th>
                    <th>{{trans('app.cgpa')}}</th>
                    <th>{{trans('app.out_of')}}</th>
                    <th class="action-buttons">{{trans('app.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employee->educations as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->exam_title}}</td>
                        <td>{{$item->institute}}</td>
                        <td>{{$item->passing_year}}</td>
                        <td>{{$item->cgpa}}</td>
                        <td>{{$item->out_of}}</td>
                        <td>
                            @if(has_permission('editEducation'))
                                <a class="btn btn-warning ajax-modal-btn" href="javascript:void(0)"
                                   data-link="{{route('employee.education.edit', $item)}}"><i class="fa fa-pencil"></i></a>
                            @endif
                            @if(has_permission('deleteEducation'))
                                <a class="btn btn-danger" href="{{route('employee.education.delete', $item)}}"
                                   onclick="return confirm('are you sure?')"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

