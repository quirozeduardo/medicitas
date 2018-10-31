<?php

namespace App\DataTables\Medical;

use App\Models\Medical\MedicalAppointment;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MedicalAppointmentDataTable extends DataTable
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
        $dataTable->rawColumns(['patient_id','doctor_id','medical_consultant_id','medical_appointment_status_id','action']);
        $dataTable->editColumn('patient_id',function($data){

            return '<a href="'.route('medical.patients.show',$data->patient->id).'">'.$data->patient->user->name.'</a>';
        });
        $dataTable->editColumn('doctor_id',function($data){

            return '<a href="'.route('medical.doctors.show',$data->doctor->id).'">'.$data->doctor->user->name.'</a>';
        });
        $dataTable->editColumn('medical_consultant_id',function($data){

            return '<a href="'.route('medical.medicalConsultants.show',$data->medicalConsultant->id).'">'.$data->medicalConsultant->name.'</a>';
        });
        $dataTable->editColumn('medical_appointment_status_id',function($data){

            return '<a href="'.route('medical.medicalAppointmentStates.show',$data->medicalAppointmentStatus->id).'">'.$data->medicalAppointmentStatus->name.'</a>';
        });
        return $dataTable->addColumn('action', 'medical.medical_appointments.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MedicalAppointment $model)
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
                'data' => 'date',
                'title' => __('medical_appointments.title_column_date'),
            ],
            [
                'data' => 'time_start',
                'title' => __('medical_appointments.title_column_time_start'),
            ],[
                'data' => 'time_end',
                'title' => __('medical_appointments.title_column_time_end'),
            ],
            [
                'data' => 'patient_id',
                'title' => __('medical_appointments.title_column_patient'),
            ],
            [
                'data' => 'doctor_id',
                'title' => __('medical_appointments.title_column_doctor'),
            ],
            [
                'data' => 'medical_consultant_id',
                'title' => __('medical_appointments.title_column_medical_consultant'),
            ],
            [
                'data' => 'medical_appointment_status_id',
                'title' => __('medical_appointments.title_column_medical_appointment_status'),
            ],
            [
                'data' => 'comments',
                'title' => __('medical_appointments.title_column_comments'),
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
        return 'medical_appointmentsdatatable_' . time();
    }
}
