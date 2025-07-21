<?php

namespace App\Services;

use App\Factories\CrudFactory;
use App\Interfaces\PermissionInterface;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class PermissionService implements PermissionInterface {
    // This class will handle permission-related logic
    // For example, checking if a user has a specific permission

    public function __construct() {
        // Initialize any dependencies or configurations here
    }

    public function hasPermission($userId, $permission) : bool{
        // Logic to check if the user has the specified permission
        // This is just a placeholder; actual implementation will depend on your data structure
        return true; // Assume user has permission for now
    }

    public function assignPermissionToRole(array $data) : void
    {
        $role = Role::find($data['role_id']);
        if (!$role) {
            throw new \Exception("Role not found");
        }

         if($role->isAlreadyAssigned($data['permission_id'])){
            throw new \Exception("Permission already assigned to this role");
        }

        try{
             $role->permissions()->attach($data['permission_id']);
        }

        catch(\Exception $e){
            throw new \Exception("Failed to assign permission: " . $e->getMessage());
        }

    }




    public function getPermissionByRole(int $roleId): array
    {
       
        // Logic to get permissions by role
        // This is just a placeholder; actual implementation will depend on your data structure
        return []; // Return an empty array for now
    }

  

    public function storePermission($data) : Permission{
        return Permission::create($data);
    }

    public function getAllPermissions() : Collection {
        return Permission::all();
    }

    public function deletePermission($id) : bool{
        $permission = Permission::find($id);
        if ($permission) {
            return $permission->delete();
        }
        return false; // Permission not found
    }

    public function updatePermission($id, $data) {
        $permission = Permission::find($id);
        if ($permission) {
            $permission->update($data);
            return $permission;
        }
        return null; // Permission not found
    }

    }