<?php

namespace App\Tabs\TabHandlers; 
use App\Interfaces\TabHandleInterface;
use App\Models\Role;

class RolesList implements TabHandleInterface {
    public function getData() : array {
        return [
            'rolesList' => [
                'roles'=> Role::all()
            ]
            ];
    }

}