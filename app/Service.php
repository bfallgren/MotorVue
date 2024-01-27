<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'motor_id',
        'service_date',
        'location',
        'cost',
        'description',
        'mileage'
    ];
     
    public function vehicle()
        {
            return $this->belongsTo('App\Motor');
        }
}
