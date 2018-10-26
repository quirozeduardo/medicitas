<?php

namespace App\DataTables\Administration;

use App\User;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $dataTable->rawColumns(['gender','roles','permissions','action']);
        $dataTable->editColumn('gender',function($data){
            if($data->gender)
                return __('male');
            else
                return __('female');
        });
        $dataTable->editColumn('roles',function($data){

            return view('administration.users.datatables_roles')
                ->with('roles',$data->roles);
        });
        $dataTable->editColumn('permissions',function($data){

            return view('administration.users.datatables_permissions')
                ->with('permissions',$data->permissions);
        });
        return $dataTable->addColumn('action', 'administration.users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'data' => 'name',
                'title' => __('users.title_column_name'),
            ],
            [
                'data' => 'last_name',
                'title' => __('users.title_column_last_name'),
            ],
            [
                'data' => 'birthdate',
                'title' => __('users.title_column_birthdate'),
            ],
            [
                'data' => 'gender',
                'title' => __('users.title_column_gender'),
            ],
            [
                'data' => 'email',
                'title' => __('users.title_column_email'),
            ],
            [
                'data' => 'roles',
                'title' => __('users.title_column_roles'),
                'searchable' => false,
                'orderable' => false
            ],
            [
                'data' => 'permissions',
                'title' => __('users.title_column_permissions'),
                'searchable' => false,
                'orderable' => false
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'usersdatatable_' . time();
    }
}
