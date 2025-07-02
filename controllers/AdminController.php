<?php

namespace controllers;

use utils\View;
use models\Role;
use services\RoleService;
use utils\CustomValidation;

class AdminController{

  private $roleService; 
  private $validation;

    public function __construct(RoleService $roleService)
    {
       $this->roleService = $roleService;
       $this->validation = new CustomValidation();
    }


    public function showAllRoles(){
     
      $roles = Role::all();
      View::render('/admin/roles/role_page.php', 'roles', ['roles' => $roles]);
    }

    public function storeRole(){
      $request = [
        'title' => $_POST['role_name'],
        'description' => $_POST['role_description']
      ];

    
     $errors = $this->validation->validateRequireField($request);

      if (!empty($errors)) {
          $_SESSION['errors_role'] = $errors;
          header('Location: /admin/roles');
          exit;
      }



      try{
          if($this->roleService->storeRole($request)){
             echo 'Role added successfully';
          }
           
          
      }
      catch(\Exception $e){
        echo 'Issue found' , $e->getMessage();
      }
        
    } 




    
}