<?php

namespace App\Interfaces;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

interface PermissionInterface{
     public function hasPermission($userId, $permission) : bool;
     public function assignPermissionToRole(array $data) : void;
     public function getPermissionByRole(int $roleId): array;
     public function storePermission(array $data) : Permission;
     public function getAllPermissions() : Collection;
     public function deletePermission(int $id) : bool;

}   