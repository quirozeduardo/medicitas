<?php

namespace App\DataTables\Medical;

use App\Models\Medical\Doctor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class DoctorDataTable extends DataTable
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
        $dataTable->editColumn('user_id',function($data){

            return $data->user->name;
        });
        $dataTable->editColumn('medical_speciality_id',function($data){

            return $data->medicalSpeciality->name;
        });
        $dataTable->editColumn('medical_consultant_id',function($data){
            $medicalConsultant = $data->medicalConsultant;
            if($medicalConsultant)
                return $medicalConsultant->name;
            else
                return '';
        });

        return $dataTable->addColumn('action', 'medical.doctors.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Doctor $model)
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
                'data' => 'user_id',
                'title' => __('doctors.title_column_user'),
            ],
            [
                'data' => 'medical_speciality_id',
                'title' => __('doctors.title_column_medical_speciality'),
            ],
            [
                'data' => 'medical_consultant_id',
                'title' => __('doctors.title_column_medical_consultant'),
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'doctorsdatatable_' . time();
    }
}
