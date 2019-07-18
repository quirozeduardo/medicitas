<?php

namespace App\Models\Medical;

use Eloquent as Model;

/**
 * Class Patient
 * @package App\Models\Medical
 * @version October 27, 2018, 12:48 am UTC
 *
 * @property \App\Models\Medical\User user
 * @property \Illuminate\Database\Eloquent\Collection MedicalAppointment
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer user_id
 * @property string observations
 */
class Patient extends Model
{

    public $table = 'patients';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'user_id',
        'observations'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'observations' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function medicalAppointments()
    {
        return $this->hasMany(\App\Models\Medical\MedicalAppointment::class);
    }
    public function doctors()
    {
        return $this->belongsToMany(\App\Models\Medical\Doctor::class, 'doctor_patient');
    }
    public function doctorPatient()
    {
        return $this->hasMany(\App\Models\Medical\DoctorPatient::class);
    }
}
