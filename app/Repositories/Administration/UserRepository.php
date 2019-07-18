<?php

namespace App\Repositories\Administration;

use App\User;
use Illuminate\Support\Facades\Hash;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories\Administration
 * @version October 21, 2018, 9:56 pm UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
*/
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'last_name',
        'birthdate',
        'gender',
        'email'
    ];



    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
