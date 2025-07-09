<?php

namespace  App\Services;

use App\Exceptions\RoleNotFoundException;
use App\Interfaces\RoleInterface;
use App\Models\Role;
use App\Models\User;
use App\Services\AuthService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\QueryException;
use utils\Logger;

class RoleService implements RoleInterface{

    private $authService;


    public function __construct()
    {
        $this->authService = AuthService::getInstance();
    }

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
          return $role->delete(); //TODO: Do soft deletion 

          //  $authUser = $this->authService->getAuthenticateUser();
          // $authUser->roles()->detach($id);
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


    public function assignRole($request){

        try{
            $user = User::find($request['user_id']);
            $role_id = $request['role_id'];
            $authUser = $this->authService->getAuthenticateUser();
            

            if(!$user){
                throw new \Exception('User not found');
            }

            if($user->hasAlreadyAssigned()){
                throw new \Exception('User is already assigned with role');
            }

           
            if(!$authUser || !$authUser->hasAnyRole(['admin', 'manager'])){
                throw new \Exception('Authenticated user is not allowed to assign role');
            }

          
            $user->roles()->attach($role_id, ['assigned_by' => $this->authService->getAuthId(), 'assigned_at' => Carbon::now()]);
            return true;
           
        }
        catch(\Exception $e){
           throw new \Exception('User not assigned to role'. $e->getMessage());
        }
       
    }
    
}