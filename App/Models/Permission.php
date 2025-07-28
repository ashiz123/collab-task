<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Permission extends Model{

    protected $table = 'permissions';
    protected $fillable  = ['title', 'description'];


    public function roles(){
        return $this->belongsToMany(Role::class);
    }


   

    
    
}

