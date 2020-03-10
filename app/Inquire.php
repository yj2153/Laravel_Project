<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquire extends Model
{
    //
    protected $table = 'inquire';

    protected $guarded = array('id');
    public $timestamps = false;

    public static $rules = array(
        'title'=>'required'
        ,'message'=>'required|min:0|max:500'
    );

    public function member(){
        return $this->hasOne('App\Member', 'id', 'member_id');  
    }

    public function replyMember(){
        return $this->hasOne('App\Member', 'id', 'reply_id');
    }
}
