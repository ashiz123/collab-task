<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use utils\View;
use App\Models\Role;
use App\Services\RoleService;
use utils\CustomValidation;
use utils\Flash;
use utils\Logger;

class AdminController extends BaseController{

  private $roleService; 
  private $validation;

    public function __construct(RoleService $roleService)
    {
       $this->roleService = $roleService;
       $this->validation = new CustomValidation();
    }


  public function index() {
    $roles = Role::all();
    $message = Flash::get('role_message'); 
    $errors = Flash::get('role_errors');
    // Logger::info( json_encode($errors));
    View::render('/admin/roles/role_page.php', 'roles', [
        'roles' => $roles,
        'message' => $message,
        'errors' => $errors
    ]);
}



    public function storeRole(){
      $request = [
        'title' => $_POST['role_name'],
        'description' => $_POST['role_description']
      ];
      
      $errors = $this->validation->validateRequireField($request);

      if (!empty($errors)) {
          Flash::set('role_errors', $errors);
          $this->redirect('/admin/roles');
          exit;
      }

      try{
          if($this->roleService->storeRole($request)){
            Flash::set('role_message', 'Role addedd successfully');
            $this->redirect('/admin/roles');
            }
           
          
      }
      catch(\Exception $e){
        echo 'Issue found' , $e->getMessage();
      }
        
    } 


    public function deleteRole($id){
      $this->roleService->deleteRole($id);
    }




    
}