<?php

namespace App\DataTables;

use App\Clients;
use App\LoanApplication;
use App\Product;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LoanApplicationDataTable extends DataTable
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
            ->addColumn('action', 'actions.loanapplication_action')
            ->editColumn('status',function(LoanApplication $application){
                if($application->status=='SETTLED'){
                    return "<span class='badge badge-success'>$application->status</span>";
                }
                if($application->status=='DISBURSED'){
                    return "<span class='badge badge-primary'>$application->status</span>";
                }
                if($application->status=='APPROVED'){
                    return "<span class='badge badge-info'>$application->status</span>";
                }
                if($application->status=='PENDING'){
                    return "<span class='badge badge-azure'>$application->status</span>";
                }
                if($application->status=='REJECTED'){
                    return "<span class='badge badge-danger'>$application->status</span>";
                }
            })
            ->editColumn('client_id',function (LoanApplication $loanApplication){
                return $loanApplication->client->name;
            })
            ->editColumn('product_id',function (LoanApplication $loanApplication){
                return $loanApplication->product->name;
            })
            ->editColumn('total_interest',function (LoanApplication $loanApplication){
                return number_format($loanApplication->total_interest,2);
            })
            ->editColumn('created_at',function (LoanApplication $loanApplication){
                return Carbon::parse($loanApplication->created_at)->toFormattedDateString();
            })
            ->editColumn('updated_at',function (LoanApplication $loanApplication){
                return Carbon::parse($loanApplication->updated_at)->toFormattedDateString();
            })
            ->rawColumns(['action','status'])
            ->order(function($query){
                $query->orderBy('id','asc');
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param LoanApplication $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LoanApplication $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     * @throws \Exception
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('loanapplication-table')
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
                    )->addTableClass('table-shopping');
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
            Column::make('client_id')->title('Client'),
            Column::make('product_id')->title('Product'),
            Column::make('rate'),
            Column::make('duration'),
            Column::make('amount_applied')->title('Applied'),
            Column::make('amount_approved')->title('Approved'),
            Column::make('total_interest')->title('Interest'),
            Column::make('approval_date'),
            Column::make('disbursement_date')->title('Disbursed on'),
            Column::make('due_date'),
            Column::make('created_at')->title('Created'),
            Column::make('status'),
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
