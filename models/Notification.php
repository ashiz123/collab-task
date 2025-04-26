<?php

namespace models;
use Illuminate\Database\Eloquent\Model;


class Notification extends Model{

    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','type', 'message',  'read_at'];
    protected $dates = ['read_at'];



    // public function setReadAtAttribute($value)
    // {
    //     $this->attributes['read_at'] = $value ?: null;
    // }

}?>