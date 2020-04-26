<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $primaryKey = 'id';
    protected $fillable =['name_uz','name_uz','parent_id'];



    public static function children ($parent=null) {
        return Region::where('parent_id',$parent)->orderBy('name_ru','desc')->get();
    }



}

