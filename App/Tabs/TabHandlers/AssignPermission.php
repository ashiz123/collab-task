<?php

namespace App\Tabs\TabHandlers;
use App\Interfaces\TabHandleInterface;
use App\Models\Role;
use App\Models\Permission;
use utils\Flash;

class AssignPermission implements TabHandleInterface {
    public function getData(): array {
        return [
            'assignPermission' => [
                'roles' => Role::all(),
                'permissions' => Permission::all(), // all permissions
                'message' => Flash::get('message'),
            ]
            ];
    }
}