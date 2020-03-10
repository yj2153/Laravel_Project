<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $table = 'bookings';
    protected $guarded = array('id');

    public $timestamps = false;

    public function board(){
        return $this->hasOne('App\Nail');
    }
}
