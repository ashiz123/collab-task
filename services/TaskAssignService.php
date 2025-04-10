<?php

namespace services;

use interfaces\TaskAssignInterface;
use models\AssignTask;
use utils\Logger;

Class TaskAssignService implements TaskAssignInterface {
    public $taskToUser;

    public function __construct()
    {   
        $this->taskToUser = new AssignTask();
    }

    public function createTaskToUser($users, $id){

        try{
            foreach($users as $user){
                $assignUser = new AssignTask();
                $assignUser->user_id = $user['id'];
                $assignUser->task_id = $id;
                $assignUser->deadline = $user['deadline'];
                $assignUser->role_name = $user['role_name'];
                $assignUser->save();
             }

             return true;
        }
        catch(\Exception $e){
            Logger::error('Task assignment failed'. $e->getMessage());
            return false;
        }
       }


    public function getAssignUsers($taskId){
         $assignUser = AssignTask::where('task_id', $taskId)->get();
         if ($assignUser->isEmpty()) {
            return null;
        }
         return $assignUser;
    }




}



?>