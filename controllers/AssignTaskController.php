<?php

namespace controllers;

use utils\Logger;
use models\AssignTask;
use services\TaskAssignService;
use services\UserService;
use services\NotificationService;
use utils\View;


class AssignTaskController {
    public $assignTaskService;
    public $userService;
    public $notificationService;

    public function __construct()
    {
        $this->assignTaskService = new TaskAssignService();
        $this->userService = new UserService();
        $this->notificationService = new NotificationService();
    }


 
    public function assignTask($id){
       $users = file_get_contents('php://input');
       parse_str($users, $inputDatas);  


       if (isset($inputDatas['users'])  && is_array($inputDatas['users'])) {
        try{
            $assignedUsers = $inputDatas['users'];
            $this->assignTaskService->assignTaskToUser($assignedUsers, $id);
            header('Location: /task/' . $id);
            exit();
        }
        catch(\Exception $e){
            Logger::error("Task assignment error", ['error' => $e->getMessage()]);
            http_response_code(500);
            echo "Error: " . $e->getMessage();
        }
    }else{
        http_response_code(400);
        echo 'Invalid user data provided';
    }
   }

   

    public function viewAssignTask(){
        if($this->userService->getTasksByUser()){
            $assignTask = $this->userService->getTasksByUser();
            View::render('/tasks/assigned_tasks.php', 'Assigned task', ['tasks' => $assignTask]);
        }else{
            echo 'user not logged in';
        }
       
    }


    public function changeStatus($assignId){
        ob_clean(); //clear the buffer if the php have return other type of data rather than json before.
        header('Content-Type: application/json');

        try{
            $status = $_POST['status'] ?? null;

            if(!$status){
                http_response_code(404);
                echo json_encode([
                    'success' => false,
                    'message' => 'Status is null'
                ]);
                return;
            }

            $assignTask = $this->assignTaskService->changeStatusOfAssignTask($assignId, $status);
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'status' => $assignTask->status,
                'message' => 'Status is updated'
            ]);
        }

        catch(\Exception $e){
            http_response_code(500); 
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


}


?>