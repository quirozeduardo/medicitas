<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $fillable = [
        'user_id'
    ];

    public function fileImage(){
        return $this->hasOne(\App\Models\File::class,'guid','image_guid');
    }

}
