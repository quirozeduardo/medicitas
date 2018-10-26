<?php

namespace App\Repositories\Medical;

use App\Models\Medical\MedicalConsultant;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MedicalConsultantRepository
 * @package App\Repositories\Medical
 * @version October 23, 2018, 9:14 pm UTC
 *
 * @method MedicalConsultant findWithoutFail($id, $columns = ['*'])
 * @method MedicalConsultant find($id, $columns = ['*'])
 * @method MedicalConsultant first($columns = ['*'])
*/
class MedicalConsultantRepository extends BaseRepository
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
        return MedicalConsultant::class;
    }
}
