<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    protected $fillable = [
     'motor_type',
     'make',
     'model',
     'mfg_year',
     'current_mileage',
     'vid',
     'license_tag',
     'insurance_policy',
     'insurance_provider',
     'mfg_warr',
     'ext_warr',
     'ext_warr_provider',
     'ext_warr_phone',
     'ext_warr_contract',
     'avatar'
 ];

 public function tasks()
    {
     return $this->hasMany('App\Task');
    }

public function services()
    {
     return $this->hasMany('App\Service');
    }
}
