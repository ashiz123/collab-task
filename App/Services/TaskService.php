<?php

namespace  App\Services;

use Exception;
use App\Interfaces\TaskInterface;
use App\Models\Task;
use utils\Logger;
use utils\View;
use App\Services\AuthService;

// service class is to use to access with database

class TaskService implements TaskInterface{
 private $authService;

    public function __construct()
    {
        $this->authService = AuthService::getInstance();
       
    }

    public function allTasks(){
        return Task::where('user_id', $this->authService->getAuthId())->orderBy('created_at', 'desc')->limit(10)->get();
       
    }


    public function storeTask(string $taskName, string $description){
        try{
            $newTask = new Task();
            $newTask->user_id = $this->authService->getAuthId();
            $newTask->task = $taskName;
            $newTask->description = $description;
            if($newTask->save()) {
             return true;
            }else{
             return false;
            }

            

        }catch(Exception $e){
            Logger::error('Exception while saving task'. $e->getMessage());
            return false;
        }
        

        
    }

    public function getTaskById($id){
        if($id){
            $task = Task::findOrFail($id);
            return $task;
        }   
        return null;
    }


    public function getAllUsersByTask($taskId){
        $task = Task::find($taskId);
        $users = $task->assignedUsers()->get();
        return $users;
    }

    public function getUserCreatedTask(){
        
    }


    public function updateTask($id){

    }


}




?>