<?php

namespace App\Services;

use utils\Logger;

class PermissionRegisteryService {

    public static function all() : array {
           return [
           'admin' => ['accept_user', 'delete_user', 'assign_user', 'create_task', 'assign_task'] , //manage user
           'manager' => ['create_task', 'assign_task', 'delete_task', 'set_task_complition', 'task_review'], //manage task
           'employee' => ['view_task', 'set_task_complition']
        ];
    }   


    public static function isValid(string $permission): bool{
       foreach(self::all() as $permissions){
            if(in_array($permission, $permissions)){
                return true;
            }
        }

        return false;
    }

    public static function getPermissionForRole(string $role){
       $permissions = self::all();
       return $permissions[$role] ?? [];
     }


    public static function doRoleHasPermission(string $role, string $permission): bool{
        $permissions = self::getPermissionForRole($role); //get all the permissions by role 
        Logger::info(json_encode($permissions) . $permission);
        $hasPermission =  in_array($permission, $permissions); //check the pass permission exist in array in above permissions by role.
        return $hasPermission;
    }

}


// $getPermission = PermissionRegisteryService::getPermissionForRole('Admin');
// var_dump($getPermission);





