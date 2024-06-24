<div class="x_content">

<div class="x_panel custom_x_panel">
<div class="x_title">
    <h2><i class="fa fa-align-left"></i> {{trans('app.module_permission')}} <small>{{trans('app.modules')}}</small></h2>
    <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>
<div class="x_content">

    <!-- start accordion -->
    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">

        @foreach($modules as $module)
            @php
                $mdlPermission  = null;
                if($role){
                    $mdlPermission =  $role->permissions->firstWhere('module_id', $module->id);
                }
            @endphp

            <div class="panel border">
                <a class="modules-title panel-heading collapsed" role="tab" id="headingTwo_{{$module->id}}" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo_{{$module->id}}" aria-expanded="false" aria-controls="_{{$module->id}}">
                    <h4 class="panel-title">{{$module->name}}</h4>
                </a>
                <div id="collapseTwo_{{$module->id}}" class="panel-collapse collapse @if(!empty($mdlPermission)) show @endif " role="tabpanel" aria-labelledby="headingTwo_{{$module->id}}">
                    <div class="panel-body">

                        @foreach($module->submodules as $submodule)
                            @php
                                $sblPermission = null;
                                if($role){
                                    $sblPermission  = $role->permissions->firstWhere('submodule_id', $submodule->id);
                                }
                            @endphp
                            <div class="x_panel custom_x_panel-submodules">
                                <div class="submodules-title x_title">
                                    <h4 class="panel-title">
                                        <input type="checkbox" @if(!empty($sblPermission)) checked @endif  class="checkbox"
                                               onclick="selectActions('module_{{$module->id}}_submodule_{{$submodule->id}}')"> {{$submodule->name}}
                                    </h4>
                                </div>
                                <div class="x_content">
                                    <div class="col-md-12 col-sm-12 col-sm-12 ml-2" id="module_{{$module->id}}_submodule_{{$submodule->id}}">

                                        @foreach($submodule->menu as $menu)
                                            @php
                                                $mnuPermission = null;
                                                    if($role){
                                                       $mnuPermission  = $role->permissions->firstWhere('menu_id', $menu->id);
                                                    }
                                            @endphp
                                            <div class="col-md-3 col-sm-3 col-12">
                                                <input  type="checkbox" @if(!empty($mnuPermission)) checked @endif id="module_{{$module->id}}_submodule_{{$submodule->id}}_menu_{{$menu->action}}"
                                                        class="checkbox" value="{{$module->id}}|{{$submodule->id}}|{{$menu->id}}_{{$submodule->name."|".$menu->action}}"  name="actions[]"> {{$menu->name}}
                                            </div>

                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                    <div class="panel-footer">
                    </div>
                </div>
            </div>

        @endforeach

    </div>
    <!-- end of accordion -->
</div>
</div>
</div>
