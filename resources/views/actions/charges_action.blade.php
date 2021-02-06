{!! Form::open(['route' => ['charges.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group btn-group-sm'>
    @can('view_charge')
        <a href="#" onclick='loadLoanApplications("{{ route('charges.show', $id) }}")' class='btn btn-default btn-sm fa fa-eye'>
        </a>
    @endcan
    @can('update_charge')
        <a href="{{ route('charges.edit', $id) }}" class='btn btn-default btn-sm fa fa-edit'>
        </a>
    @endcan
    @can('delete_charge')
        {!! Form::button('',[
            'type' => 'submit',
            'class' => 'btn btn-danger btn-sm fa fa-trash',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
