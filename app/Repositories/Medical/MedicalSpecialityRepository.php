<?php

namespace App\Repositories\Medical;

use App\Models\Medical\MedicalSpeciality;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MedicalSpecialityRepository
 * @package App\Repositories\Medical
 * @version October 23, 2018, 9:16 pm UTC
 *
 * @method MedicalSpeciality findWithoutFail($id, $columns = ['*'])
 * @method MedicalSpeciality find($id, $columns = ['*'])
 * @method MedicalSpeciality first($columns = ['*'])
*/
class MedicalSpecialityRepository extends BaseRepository
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
        return MedicalSpeciality::class;
    }
}
