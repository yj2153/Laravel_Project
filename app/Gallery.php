<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    protected $table = 'gallerys';

    protected $guarded = array('id');
    public $timestamps = false;

    public static $rules = array(
        'title' => 'required',
        'image'=>'required|mimes:jpeg,png,jpg,gif'
    );

}
