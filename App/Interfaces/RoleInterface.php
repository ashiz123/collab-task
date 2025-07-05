<?php
 

 namespace App\Interfaces;

use App\Models\Role;

 interface RoleInterface{
    public function storeRole(array $data) : Role;
    public function updateRole(int $id, array $data): Role;
    public function deleteRole(int $id) : bool;
    public function findById(int $id ): ?Role;


 }