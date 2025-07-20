<?php

namespace App\Tabs\TabHandlers;
use App\Interfaces\TabHandleInterface;
use App\Models\Role;
use App\Models\User;

class UserRole implements TabHandleInterface {
    public function getData() : array {
        return [
            'userRoles' => [
               'users' => User::getAllSortedByRoleId(),
              'roles' => Role::all() // TODO: remove this.
            ]
        ];
    }
}
