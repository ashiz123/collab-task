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


    public function hasPermission($permissionName){
       return $this->permissions()->where('title', $permissionName)->exists();
    }

    //  public static function doRoleHasPermission(string $role, string $permission): bool{
    //     $permissions = self::getPermissionForRole($role); //get all the permissions by role 
    //     Logger::info(json_encode($permissions) . $permission);
    //     $hasPermission =  in_array($permission, $permissions); //check the pass permission exist in array in above permissions by role.
    //     return $hasPermission;
    // }



   



}