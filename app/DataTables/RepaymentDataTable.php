<?php

namespace App\DataTables;

use App\LoanApplication;
use App\Repayment;
use Carbon\Carbon;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RepaymentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('loan_application_id',function(Repayment $repayment){
                return $repayment->client()->first()->name;
            })
            ->editColumn('status',function(Repayment $repayment){
                if($repayment->status==1){
                    return "<span class='badge badge-success'>PAID</span>";
                }
                if(Carbon::parse($repayment->due_date)->isPast()) {
                    if ($repayment->status == 0) {
                        return "<span class='badge badge-danger'>PENDING</span>";
                    }
                }else{
                    if ($repayment->status == 0) {
                        return "<span class='badge badge-info'>PENDING</span>";
                    }
                }
            })
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Repayment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Repayment $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('repaymentdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0,'asc')
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('loan_application_id'),
            Column::make('amount'),
            Column::make('amount_paid'),
            Column::make('amount_default'),
            Column::make('penalty'),
            Column::make('total_to_pay'),
            Column::make('due_date'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Repayment_' . date('YmdHis');
    }
}
