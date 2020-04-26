<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $primaryKey = 'id';
    protected $fillable =['name_uz','name_uz','region_id','type','description_uz','description_ru'
    ,'phone_numbers','adress_uz','adress_ru','work_time','location'];
}
