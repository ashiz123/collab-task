<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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