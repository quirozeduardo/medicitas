<?php

namespace App\Models\Medical;

use Illuminate\Database\Eloquent\Model;

class DoctorPatient extends Model
{
    protected $table = 'doctor_patient';
    public function patients()
    {
        return $this->hasMany(\App\Models\Medical\Patient::class);
    }
    public function doctors()
    {
        return $this->hasMany(\App\Models\Medical\Doctor::class);
    }
}
