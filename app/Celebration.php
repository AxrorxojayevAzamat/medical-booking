<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Celebration extends Model
{
    protected $primaryKey = 'id';
    protected $fillable =['date','quantity','celebration_name'];

}
