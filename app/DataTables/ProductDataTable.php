<?php

namespace App\DataTables;

use App\Product;
use Carbon\Carbon;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
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
            ->editColumn('status',function(Product $product){
                if($product->status=='ACTIVE'){
                    return "<span class='badge badge-success'>$product->status</span>";
                }
                if($product->status=='INACTIVE'){
                    return "<span class='badge badge-danger'>$product->status</span>";
                }
            })
            ->editColumn('created_at',function (Product $product){
                return Carbon::parse($product->created_at)->toFormattedDateString();
            })
            ->editColumn('updated_at',function (Product $product){
                return Carbon::parse($product->updated_at)->toFormattedDateString();
            })
            ->addColumn('action', 'actions.product_action')
            ->rawColumns(['status','action'])
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
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
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0,'asc')
                    ->addTableClass('table-shopping')
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
            Column::make('name'),
            Column::make('code'),
            Column::make('min_amount'),
            Column::make('max_amount'),
            Column::make('rate'),
            Column::make('min_duration'),
            Column::make('max_duration'),
            Column::make('security'),
            Column::make('status'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(true)
                ->printable(true)
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
        return 'Product_' . date('YmdHis');
    }
}
