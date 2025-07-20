<?php

 namespace App\Tabs\TabHandlers;

use App\Interfaces\TabHandleInterface;
use utils\Flash;

class CreateRole implements TabHandleInterface{
    public function getData() : array {
       return [
         'createRole' => [
            'errors' => Flash::get('role_errors'),
            'message' => Flash::get('create_role')
         ]
         ];
    }
}