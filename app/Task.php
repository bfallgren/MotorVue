<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   protected $fillable = [
    'motor_id',
   	'description',
   	'mileage_interval',
   	'month_interval',
   	'last_completed_miles',
   	'last_completed_date'
   ];

   public function vehicle()
    {
    	return $this->belongsTo('App\Motor');
    }
}
