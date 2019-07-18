<?php

namespace App\Repositories\Laboratory;

use App\Models\Laboratory\Analisis;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AnalisisRepository
 * @package App\Repositories\Laboratory
 * @version April 11, 2019, 2:00 am UTC
 *
 * @method Analisis findWithoutFail($id, $columns = ['*'])
 * @method Analisis find($id, $columns = ['*'])
 * @method Analisis first($columns = ['*'])
*/
class AnalisisRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'status',
        'patient_id',
        'arrived_analysis_date',
        'type_analisis_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Analisis::class;
    }
}
