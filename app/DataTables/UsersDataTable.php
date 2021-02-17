<?php

namespace App\DataTables;

use App\User;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn('action', 'actions.user_action')
            ->editColumn('role',function(User $user){
                if(isset(json_decode($user->roles)[0]->name)) {
                    $role = json_decode($user->roles)[0]->name;
                    if ($role == 'superadministrator') {
                        return "<span class='badge badge-success'>$role</span>";
                    }
                    if ($role == 'administrator') {
                        return "<span class='badge badge-primary'>$role</span>";
                    }
                    if ($role == 'agent') {
                        return "<span class='badge badge-secondary'>$role</span>";
                    }
                }else{
                    return '0';
                }
            })
            ->editColumn('created_at',function (User $user){
                return Carbon::parse($user->created_at)->toFormattedDateString();
            })
            ->editColumn('updated_at',function (User $user){
                return Carbon::parse($user->updated_at)->toFormattedDateString();
            })
            ->rawColumns(['action','role']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('users-table')->addTableClass('table-striped')
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
            Column::make('name'),
            Column::make('email'),
            Column::make('role'),
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
        return 'Users_' . date('YmdHis');
    }
}
