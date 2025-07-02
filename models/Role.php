<?php

namespace models;
use Illuminate\Database\Eloquent\Model;
use models\User;

class Role extends Model{

    protected $table = 'role';
    protected $fillable = ['title', 'description'];


  

    public function users()
    {
        return $this->hasMany(User::class, 'user_role' , 'role_id', 'user_id');
    }

}