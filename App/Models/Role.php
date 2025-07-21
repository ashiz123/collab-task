<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model{

    protected $table = 'role';
    protected $fillable = ['title', 'description'];


  

    public function users()
    {
        return $this->hasMany(User::class, 'user_role' , 'role_id', 'user_id');
    }

    public function permissions() : BelongsToMany{
        return $this->belongsToMany(Permission::class, 'role_permissions', 'role_id', 'permission_id');
    }

    public function isAlreadyAssigned($permissionId): bool{
        return $this->permissions()->where('permission_id', $permissionId)->exists();
    }

}