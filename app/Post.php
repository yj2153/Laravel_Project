<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table = 'posts';
    public $timestamps = false;

    public function member(){
        return $this->hasOne('App\Member','id', 'member_id');
    }
    
    public function replys(){
        return $this->hasMany('App\Post', 'reply_posts_id', 'id');  
    }

    public function getID(){
        return $this->id;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getCreate(){
        return $this->created;
    }

    public function getMemberID(){
        return $this->member_id;
    }
}
