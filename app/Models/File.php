<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sujip\Guid\Guid;

class File extends Model
{
    protected $primaryKey = 'guid';
    public $incrementing = false;
    protected $fillable = [
        'guid'
    ];
    public static function guidDistinct(){
        $guidObj = new Guid();
        $guid = $guidObj->create();
        if(File::where('guid',$guid)->get()->count() >0)
            return File::guidDistinct();
        else
            return $guid;
    }
}
