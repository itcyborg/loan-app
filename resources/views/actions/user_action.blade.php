{!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="#" onclick='loadUser("{{ route('users.show', $id) }}")' class='btn btn-default btn-sm fa fa-eye'>
    </a>
    <a href="#" onclick='loadUser(" {{ route('users.show', $id) }}",true,"{{route('users.edit',$id)}}")' class='btn btn-default btn-sm fa fa-edit'>
    </a>
    {!! Form::button('',[
        'type' => 'submit',
        'class' => 'btn btn-danger btn-sm fa fa-trash',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
