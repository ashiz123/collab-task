<?php

namespace App\Factories;


class CrudFactory {
    public static function make($type) {
        return match($type) {
            // 'role' => new \App\Crud\RoleCrud(),
            // 'permission' => new \App\Crud\PermissionCrud(),
            default => throw new \InvalidArgumentException("Unknown CRUD type: $type")
        };
    }
}

