<?php

namespace App\Tabs\TabHandlers;
use App\Interfaces\TabHandleInterface;
use utils\Flash;

class CreatePermission implements TabHandleInterface{
    public function getData(): array {
        return [
            'createPermission' => [
                'errors' => Flash::get('permission_errors'),
                'message' => Flash::get('create_permission')    
            ]
            ];
    }
}