<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Relations\Pivot;

class BasePivot extends Pivot
{
    public $timestamps = false;
}
