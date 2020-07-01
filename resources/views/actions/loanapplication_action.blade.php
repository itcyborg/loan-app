{!! Form::open(['route' => ['loan-applications.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="#" onclick='loadLoanApplications("{{ route('loan-applications.show', $id) }}")' class='btn btn-default btn-sm fa fa-eye'>
    </a>
    <a href="{{ route('loan-applications.edit', $id) }}" class='btn btn-default btn-sm fa fa-edit'>
    </a>
    {!! Form::button('',[
        'type' => 'submit',
        'class' => 'btn btn-danger btn-sm fa fa-trash',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
