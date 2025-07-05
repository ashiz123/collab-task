<?php

namespace  App\Services;


use App\Interfaces\TaskAssignInterface;
use App\Models\AssignTask;
use models\Task;
use utils\Logger;
use App\Services\NotificationService;

Class TaskAssignService implements TaskAssignInterface {
    public $taskToUser;
    public $notificationService;
    protected $connection;


    public function __construct()
    {   
        $this->taskToUser = new AssignTask();
        $this->notificationService = new NotificationService();
        $this->connection =  $this->taskToUser->getConnection();
         //We cant use facades so did getConnection to instance of the model.
    }

    public function assignTaskToUser($users, $id){
        $this->connection->beginTransaction();
        try{
             foreach($users as $user){
                $assignUser = new AssignTask();
                $assignUser->user_id = $user['id'];
                $assignUser->task_id = $id;
                $assignUser->deadline = $user['deadline'];
                $assignUser->role_name = $user['role_name'];

                if(!$assignUser->save()){
                    throw new \Exception("Failed to assign task to user ID {$user['id']}");
                }

                $taskTitle =  $assignUser->task->task;

                $this->notificationService->send(
                    $assignUser->user_id, 
                    $assignUser->id,
                    "Task Assigned: $taskTitle",
                    "You are now assigned new task as $assignUser->role_name", 
                    'task-assign',
                    'database'
                );

             }

            $this->connection->commit();
           
        }
        catch(\Exception $e){
            $this->connection->rollBack();
            Logger::error('Task assignment failed'. $e->getMessage());
            throw new \Exception("Task assignment failed: " . $e->getMessage());
        }
       }


    public function getAssignUsers($taskId){
         $assignUser = AssignTask::where('task_id', $taskId)->get();
         if ($assignUser->isEmpty()) {
            return null;
        }
         return $assignUser;
    }


    public function changeStatusOfAssignTask($assignedTaskId , $status){

        $this->connection->beginTransaction();
        try{
            $assignTask = AssignTask::find($assignedTaskId);

            if(!$assignTask){
                throw new \Exception('Assigned task  not found:  $assignedTaskId');
            }

            $assignTask->status = $status;
           if($assignTask->save()) {
                $assignedTaskCreatedById = $assignTask->task->createdUser->id;
                $assignedTaskTitle = $assignTask->task->task;
                $assignedTaskStatus = $assignTask->status;

                $this->notificationService->send(
                    $assignedTaskCreatedById, 
                    $assignTask->id,
                    'Status updated',
                    "$assignedTaskTitle status updated to $assignedTaskStatus . ", 
                    'task-status',
                    'database'
                );
    
           }else{
            throw new \Exception('Assigned task  not updated of:  $assignedTaskId');
           }
            
           $this->connection->commit();
            return $assignTask;
        }
        catch(\Exception $e){
            $this->connection->rollBack();
            Logger::error('Task assignment failed'. $e->getMessage());
            throw new \Exception("Task assignment failed: " . $e->getMessage());
        }
    }

  


}



?>