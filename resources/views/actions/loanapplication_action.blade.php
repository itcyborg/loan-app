<div class='btn-group btn-group-sm'>
    @can('view_loan')
        <a href="#" onclick='loadLoanApplications("{{ route('loan-applications.show', $id) }}")' class='btn btn-default btn-sm fa fa-eye' data-toggle="tooltip" data-placement="top" title="View Application">
        </a>
    @endcan
    <a href="{{ route('loan-applications.edit', $id) }}" class='btn btn-danger btn-sm fa fa-ban' data-toggle="tooltip" data-placement="top" title="Cancel Application">
    </a>
</div>
