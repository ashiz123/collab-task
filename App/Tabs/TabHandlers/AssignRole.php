<?php

namespace App\Tabs\TabHandlers;
use App\Interfaces\TabHandleInterface;
use App\Models\Role;
use App\Models\User;


class AssignRole implements TabHandleInterface {
    public function getData() : array {
        return [
            'assignRole' => [
                'users' => User::all(), //those user who is not assigned any role
                'roles' => Role::all() //all roles
            ]
        ];
    }
}