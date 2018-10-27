<?php

namespace App\Repositories\Medical;

use App\Models\Medical\Patient;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PatientRepository
 * @package App\Repositories\Medical
 * @version October 27, 2018, 12:48 am UTC
 *
 * @method Patient findWithoutFail($id, $columns = ['*'])
 * @method Patient find($id, $columns = ['*'])
 * @method Patient first($columns = ['*'])
*/
class PatientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'observations'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Patient::class;
    }
}
