<?php

namespace App\Repositories\Medical;

use App\Models\Medical\Doctor;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DoctorRepository
 * @package App\Repositories\Medical
 * @version October 23, 2018, 9:10 pm UTC
 *
 * @method Doctor findWithoutFail($id, $columns = ['*'])
 * @method Doctor find($id, $columns = ['*'])
 * @method Doctor first($columns = ['*'])
*/
class DoctorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'medical_speciality_id',
        'medical_consultant_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Doctor::class;
    }
}
