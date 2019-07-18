<?php

namespace App\Repositories\Medical;

use App\Models\Medical\MedicalAppointment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MedicalAppointmentRepository
 * @package App\Repositories\Medical
 * @version October 27, 2018, 6:33 am UTC
 *
 * @method MedicalAppointment findWithoutFail($id, $columns = ['*'])
 * @method MedicalAppointment find($id, $columns = ['*'])
 * @method MedicalAppointment first($columns = ['*'])
*/
class MedicalAppointmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date',
        'time_start',
        'time_end',
        'patient_id',
        'doctor_id',
        'medical_consultant_id',
        'medical_appointment_status_id',
        'comments'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MedicalAppointment::class;
    }
}
