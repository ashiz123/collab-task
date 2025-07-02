<?php
 

 namespace interfaces;

use models\Role;

 interface RoleInterface{
    public function storeRole(array $data) : Role;
    public function updateRole(int $id, array $data): Role;
    public function deleteRole(int $id) : bool;
    public function findById(int $id ): ?Role;


 }