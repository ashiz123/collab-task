<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use utils\View;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use utils\Template;
use utils\CustomValidation;
use utils\Flash;
use utils\Logger;
use App\Services\TabDataService;
use App\Factories\TabHandleFactory;


class AdminController extends BaseController{

  private $roleService; 
  private $validation;
  

    public function __construct(RoleService $roleService)
    {
       $this->roleService = $roleService;
       $this->validation = new CustomValidation();
       
    }

    public function index() {
        $activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'create-role';
        $makeActiveTab = TabHandleFactory::make($activeTab);
        $data = $makeActiveTab->getData();    
        $tabService = new TabDataService($activeTab, $data);    
        View::render('/admin/admin_layout.php', 'Admin Panel', [
            'tabDataService' => $tabService,
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
          $this->redirect('/admin');
          exit;
      }

      try{
          if($this->roleService->storeRole($request)){
            Flash::set('create_role', 'Role addedd successfully');
            $this->redirect('/admin?tab=create-role');
            }
           
          
      }
      catch(\Exception $e){
        echo 'Issue found' , $e->getMessage();
      }
        
    } 



    public function deleteRole($id){
      if($this->roleService->deleteRole($id)){
          Flash::set('role_message', 'Role removed');
          $this->redirect('/admin/roles');
      }
      
    }


    public function assignRole(){
      
        $request = [
          'user_id' =>  $_POST['user_id'],
          'role_id'=> $_POST['role_id']
        ];

        //validation
        if (empty($request['user_id']) || empty($request['role_id'])) {
        http_response_code(400);
        echo 'Missing user_id or role_id.';
        return;
        }

      try{
      $success = $this->roleService->assignRole($request);
      if($success){
         Flash::set('assign_role_message', 'Role assigned to user successfully');
         $this->redirect('/admin?tab=assign-role');
      }
     }

     catch(\Exception $e){
          http_response_code(500);
          Flash::set('error_message', $e->getMessage());
          $this->redirect('/admin?tab=assign-role');
     }
    }




    
}