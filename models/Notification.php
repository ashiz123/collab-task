<?php

namespace models;
use Illuminate\Database\Eloquent\Model;
use models\User;

class Notification extends Model{

    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'assign_id', 'type','title', 'message',  'read_at'];
    protected $dates = ['read_at'];

    public function notificationToUser(){
        return $this->hasOne(User::class);
     }



    // public function setReadAtAttribute($value)
    // {
    //     $this->attributes['read_at'] = $value ?: null;
    // }

}?>