<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Member extends Authenticatable
{
    use Notifiable;
    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'members';
    //
    protected $guarded = array('id');
    
    public $timestamps = false;
    public static $rules = array(
        'email'=>'required'
        ,'password'=>'required'
    );

    public static $registRules = array(
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:members',
        'password' => 'required|string|min:8|confirmed',
    );
    public static $resetRules = array(
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8|confirmed',
    );

    public function getName(){
        return $this->name;
    }
}
