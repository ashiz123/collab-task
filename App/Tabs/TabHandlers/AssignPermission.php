<?php

namespace App\Tabs\TabHandlers;
use App\Interfaces\TabHandleInterface;
use App\Models\Role;
use App\Models\Permission;


class AssignPermission implements TabHandleInterface {
    public function getData(): array {
        return [
            'assignPermission' => [
                'roles' => Role::all(),
                'permission' => Permission::all() // all permissions
            ]
            ];
    }
}