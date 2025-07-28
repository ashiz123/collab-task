<?php

namespace App\Factories;
use App\Tabs\TabHandlers\AssignRole;
use App\Tabs\TabHandlers\CreateRole ;
use App\Tabs\TabHandlers\RolesList;
use App\Tabs\TabHandlers\UserRole;
use App\Tabs\TabHandlers\CreatePermission;
use App\Tabs\TabHandlers\AssignPermission;

class TabHandleFactory{
    public static function make(string $tabName) {
        return match($tabName) {
            'create-role' => new CreateRole(),
            'create-permission' => new CreatePermission(),
            'assign-role' => new AssignRole(),
            'user-roles' => new UserRole(),
            'assign-permission' => new AssignPermission(),
            };
    }
}