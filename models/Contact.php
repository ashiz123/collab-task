<?php

namespace models;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model {
    protected $table = 'contact';
    protected $primary = 'id';
    protected $fillable = ['name', 'email', 'phone', 'message' ];


}


?>