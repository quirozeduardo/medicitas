<?php

namespace App\Repositories\Laboratory;

use App\Models\Laboratory\TypeAnalisis;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TypeAnalisisRepository
 * @package App\Repositories\Laboratory
 * @version April 11, 2019, 1:19 am UTC
 *
 * @method TypeAnalisis findWithoutFail($id, $columns = ['*'])
 * @method TypeAnalisis find($id, $columns = ['*'])
 * @method TypeAnalisis first($columns = ['*'])
*/
class TypeAnalisisRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description',
        'time_delay'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TypeAnalisis::class;
    }
}
