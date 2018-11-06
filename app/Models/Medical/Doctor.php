<?php

namespace App\Models\Medical;

use Eloquent as Model;

/**
 * Class Doctor
 * @package App\Models\Medical
 * @version October 23, 2018, 9:10 pm UTC
 *
 * @property \App\Models\Medical\MedicalConsultant medicalConsultant
 * @property \App\Models\Medical\MedicalSpecialty medicalSpeciality
 * @property \App\Models\Medical\User user
 * @property \Illuminate\Database\Eloquent\Collection MedicalAppointment
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property integer user_id
 * @property integer medical_speciality_id
 * @property integer medical_consultant_id
 */
class Doctor extends Model
{

    public $table = 'doctors';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'user_id',
        'medical_speciality_id',
        'medical_consultant_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'medical_speciality_id' => 'integer',
        'medical_consultant_id' => 'integer'
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
    public function medicalConsultant()
    {
        return $this->belongsTo(\App\Models\Medical\MedicalConsultant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function medicalSpeciality()
    {
        return $this->belongsTo(\App\Models\Medical\MedicalSpeciality::class);
    }

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

    public function patients()
    {
        return $this->belongsToMany(\App\Models\Medical\Patient::class, 'doctor_patient');
    }
}
