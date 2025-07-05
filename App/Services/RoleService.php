<?php

namespace  App\Services;

use App\Exceptions\RoleNotFoundException;
use App\Interfaces\RoleInterface;
use App\Models\Role;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\QueryException;

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
      try{
          $role = Role::findOrFail($id);
          return $role->delete(); //Do soft deletion 
      }
      catch (ModelNotFoundException $e){
          throw new RoleNotFoundException("Role with ID $id not found");
           return false;
      }
        
    }


    public function findById(int $id ) : ?Role{
        $role = Role::find($id);
        return $role;
    }
    
}