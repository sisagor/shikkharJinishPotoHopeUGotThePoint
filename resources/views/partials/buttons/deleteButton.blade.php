{{--return edit button--}}
<a class="btn btn-danger" onclick="return confirm('are you sure?')" href="{{ get_menu_route(session('deleteAction'), $id) }}">
    <i class="fa fa-trash-o button_icon"> </i>
</a>

