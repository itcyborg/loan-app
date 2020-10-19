<?php

namespace App\DataTables;

use App\Clients;
use App\LoanApplication;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LoanApplicationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'actions.loanapplication_action')
            ->editColumn('client_id',function (LoanApplication $loanApplication){
                return $loanApplication->client->name;
            })
            ->editColumn('product_id',function (LoanApplication $loanApplication){
                return $loanApplication->product->name;
            })
            ->editColumn('created_at',function (LoanApplication $loanApplication){
                return Carbon::parse($loanApplication->created_at)->toFormattedDateString();
            })
            ->editColumn('updated_at',function (LoanApplication $loanApplication){
                return Carbon::parse($loanApplication->updated_at)->toFormattedDateString();
            })
            ->rawColumns(['action'])->order(function($query){
                $query->orderBy('id','asc');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\LoanApplication $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LoanApplication $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('loanapplication-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('client_id'),
            Column::make('product_id'),
            Column::make('rate'),
            Column::make('duration'),
            Column::make('amount_applied'),
            Column::make('amount_approved'),
            Column::make('total_interest'),
            Column::make('approval_date'),
            Column::make('disbursement_date'),
            Column::make('due_date'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'LoanApplication_' . date('YmdHis');
    }
}
