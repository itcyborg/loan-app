<?php

namespace App\DataTables;

use App\Client;
use App\Clients;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientsDataTable extends DataTable
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
            ->editColumn('created_at',function (Clients $clients){
                return Carbon::parse($clients->created_at)->toFormattedDateString();
            })
            ->editColumn('updated_at',function (Clients $clients){
                return Carbon::parse($clients->updated_at)->toFormattedDateString();
            })
            ->editColumn('date_of_birth',function (Clients $clients){
                return Carbon::parse($clients->date_of_birth)->toFormattedDateString();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
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
                    ->setTableId('clients-table')
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
            Column::make('name'),
            Column::make('email'),
            Column::make('gender'),
            Column::make('identification_document'),
            Column::make('identification_number'),
            Column::make('primary_contact'),
            Column::make('alternative_contact'),
            Column::make('address'),
            Column::make('date_of_birth'),
            Column::make('nationality'),
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
        return 'Clients_' . date('YmdHis');
    }
}
