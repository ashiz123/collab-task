<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use utils\CustomValidation;
use utils\Flash;


class PermissionController extends BaseController {


    private $permissionService;
    private $validation;

    public function __construct($permissionService) {
        $this->permissionService = $permissionService;
        $this->validation = new CustomValidation();
    }   
    


    public function store(){
        $data = [
            'title' => $_POST['permission_name'] ?? '',
            'description' => $_POST['permission_description'] ?? ''
        ];

        $errors = $this->validation->validateRequireField($data);
            if (!empty($errors)) {
                Flash::set('permission_errors', $errors);
                $this->redirect('/admin?tab=create-permission');
                exit;
            }


        try{    
               $permission = $this->permissionService->storePermission($data);
               if($permission){
                    Flash::set('create_permission', 'Permission addedd successfully');
                    $this->redirect('/admin?tab=create-permission');
               }
        }
        catch(\Exception $e){
            http_response_code(500);
            echo ('Error occured while creating permission: ' . $e->getMessage());
        }
    }


    public function assignPermission(){
        $data = [
            'role_id' => $_POST['role_id'] ?? '',
            'permission_id' => $_POST['permission_id'] ?? ''
        ];

        if(empty($data['role_id'] || empty($data['permission_id']))){
            Flash::set('errors', ['role_id' => 'Role is required', 'permission_id' => 'Permission is required']);
            $this->redirect('/admin?tab=assign-permission');
            exit;
        }

        try{
                $this->permissionService->assignPermissionToRole($data);
                Flash::set('message', 'Permission assigned to role successfully');
                $this->redirect('/admin?tab=assign-permission');    
            
        }

        catch(\Exception $e){
            http_response_code(500);
            print_r('Error while assigning permission: ' . $e->getMessage());
        //     Flash::set('error_message', $e->getMessage());
        //     // $this->redirect('/error_500');   //need to create this page;
        //     $this->redirect('/admin?tab=assign-permission');
        // }

        

    }
}

}