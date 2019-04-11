<?php

namespace App\Models\Laboratory;

use Eloquent as Model;

/**
 * Class Analisis
 * @package App\Models\Laboratory
 * @version April 11, 2019, 2:00 am UTC
 *
 * @property \App\Models\Laboratory\Patient patient
 * @property \App\Models\Laboratory\TypeAnalisi typeAnalisi
 * @property \Illuminate\Database\Eloquent\Collection doctorPatient
 * @property \Illuminate\Database\Eloquent\Collection roleHasPermissions
 * @property \Illuminate\Database\Eloquent\Collection userDetails
 * @property integer status
 * @property integer patient_id
 * @property string|\Carbon\Carbon arrived_analysis_date
 * @property integer type_analisis_id
 */
class Analisis extends Model
{

    public $table = 'analisis';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'status',
        'patient_id',
        'arrived_analysis_date',
        'type_analisis_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'status' => 'integer',
        'patient_id' => 'integer',
        'type_analisis_id' => 'integer'
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
    public function patient()
    {
        return $this->belongsTo(\App\Models\Laboratory\Patient::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function typeAnalisi()
    {
        return $this->belongsTo(\App\Models\Laboratory\TypeAnalisi::class);
    }
}
