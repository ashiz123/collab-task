<?php

namespace services;

use interfaces\RoleInterface;
use models\Role;

class RoleService implements RoleInterface{

    public function storeRole(array $request) : Role{
         return Role::create([
            'title' => $request['title'],
            'description' => $request['description']
        ]);
    }


    public function updateRole(int $id, array $request) : Role{
        $role = Role::find($id);
        $role->title = $request['title'];
        $role->description = $request['description'];
        $role->save();
        
        return $role;
    }



    public function deleteRole(int $id) : bool{
        $role = Role::find($id);
        $role->delete(); //Do soft deletion 
        return true;
    }


    public function findById(int $id ) : ?Role{
        $role = Role::find($id);
        return $role;
    }
    
}