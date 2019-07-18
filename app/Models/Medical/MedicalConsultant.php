<?php

namespace App\Models\Medical;

use Eloquent as Model;

/**
 * Class MedicalConsultant
 * @package App\Models\Medical
 * @version October 23, 2018, 9:14 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Doctor
 * @property \Illuminate\Database\Eloquent\Collection MedicalAppointment
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string name
 * @property string description
 */
class MedicalConsultant extends Model
{

    public $table = 'medical_consultants';
    
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function medicalAppointments()
    {
        return $this->hasMany(\App\Models\Medical\MedicalAppointment::class);
    }
}
