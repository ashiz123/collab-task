<?php

namespace controllers;

use utils\Logger;
use models\AssignTask;
use services\TaskAssignService;
use services\UserService;
use utils\View;

class AssignTaskController {
    public $assignTaskService;
    public $userService;

    public function __construct()
    {
        $this->assignTaskService = new TaskAssignService();
        $this->userService = new UserService();
    }


 
    public function assignTask($id){
       $users = file_get_contents('php://input');
       parse_str($users, $inputDatas);  


       if (isset($inputDatas['users'])  && is_array($inputDatas['users'])) {
        $assignedUsers = $inputDatas['users'];
          if( $this->assignTaskService->createTaskToUser($assignedUsers, $id)){
               header('Location: /task/' . $id);
               exit();
           }
        }
      else {
        error_log('No users data found.');
      }
      
    }

    public function viewAssignTask(){
       $assignTask = $this->userService->getTasksByUser();
       View::render('/tasks/assigned_tasks.php', 'Assigned task', ['tasks' => $assignTask, '']);
    }


}


?>