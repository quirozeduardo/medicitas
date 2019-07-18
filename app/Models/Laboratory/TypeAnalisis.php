<?php

namespace App\Models\Laboratory;

use Eloquent as Model;

/**
 * Class TypeAnalisis
 * @package App\Models\Laboratory
 * @version April 11, 2019, 1:19 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection doctorPatient
 * @property \Illuminate\Database\Eloquent\Collection LaboratoryAnalisi
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property \Illuminate\Database\Eloquent\Collection userDetails
 * @property string name
 * @property string description
 * @property integer time_delay
 */
class TypeAnalisis extends Model
{

    public $table = 'type_analisis';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'description',
        'time_delay'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'time_delay' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function laboratoryAnalisis()
    {
        return $this->hasMany(\App\Models\Laboratory\LaboratoryAnalisi::class);
    }
}
