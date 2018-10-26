<?php

namespace App\Repositories\Medical;

use App\Models\Medical\MedicalAppointmentState;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MedicalAppointmentStateRepository
 * @package App\Repositories\Medical
 * @version October 23, 2018, 9:13 pm UTC
 *
 * @method MedicalAppointmentState findWithoutFail($id, $columns = ['*'])
 * @method MedicalAppointmentState find($id, $columns = ['*'])
 * @method MedicalAppointmentState first($columns = ['*'])
*/
class MedicalAppointmentStateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MedicalAppointmentState::class;
    }
}
