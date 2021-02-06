{!! Form::open(['route' => ['products.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group btn-group-sm'>
    @can('view_product')
        <a href="#" onclick='loadProduct("{{ route('products.show', $id) }}",false)' class='btn btn-default btn-sm fa fa-eye'>
        </a>
    @endcan
    @can('update_product')
        <a href="#" onclick='loadProduct(" {{ route('products.show', $id) }}",true,"{{route('products.edit',$id)}}")' class='btn btn-default btn-sm fa fa-edit'>
        </a>
    @endcan
    @can('delete_product')
        {!! Form::button('',[
            'type' => 'submit',
            'class' => 'btn btn-danger btn-sm fa fa-trash',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
