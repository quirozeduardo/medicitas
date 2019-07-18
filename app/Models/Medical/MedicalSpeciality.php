<?php

namespace App\Models\Medical;

use Eloquent as Model;

/**
 * Class MedicalSpeciality
 * @package App\Models\Medical
 * @version October 23, 2018, 9:16 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Doctor
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string description
 */
class MedicalSpeciality extends Model
{

    public $table = 'medical_specialties';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string'
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
    public function doctors()
    {
        return $this->hasMany(\App\Models\Medical\Doctor::class);
    }
}
