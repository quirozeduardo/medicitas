<?php

namespace App\Models\Medical;

use Eloquent as Model;

/**
 * Class MedicalAppointment
 * @package App\Models\Medical
 * @version October 27, 2018, 6:33 am UTC
 *
 * @property \App\Models\Medical\Doctor doctor
 * @property \App\Models\Medical\MedicalAppointmentState medicalAppointmentState
 * @property \App\Models\Medical\MedicalConsultant medicalConsultant
 * @property \App\Models\Medical\Patient patient
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property string|\Carbon\Carbon datetime
 * @property integer patient_id
 * @property integer doctor_id
 * @property integer medical_consultant_id
 * @property integer medical_appointment_status_id
 * @property string comments
 */
class MedicalAppointment extends Model
{

    public $table = 'medical_appointments';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'date',
        'time_start',
        'time_end',
        'patient_id',
        'doctor_id',
        'medical_consultant_id',
        'medical_appointment_status_id',
        'comments'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'doctor_id' => 'integer',
        'medical_consultant_id' => 'integer',
        'medical_appointment_status_id' => 'integer',
        'comments' => 'string'
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
    public function doctor()
    {
        return $this->belongsTo(\App\Models\Medical\Doctor::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function medicalAppointmentStatus()
    {
        return $this->belongsTo(\App\Models\Medical\MedicalAppointmentState::class);
    }

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
    public function patient()
    {
        return $this->belongsTo(\App\Models\Medical\Patient::class);
    }
}
