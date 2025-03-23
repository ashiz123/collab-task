<?php

namespace services;

use Exception;
use interfaces\TaskInterface;
use models\Task;
use utils\Logger;
use utils\View;

class TaskService implements TaskInterface{

    


    public function allTasks(){
        return Task::orderBy('created_at', 'desc')->limit(10)->get();
       
    }


    public function storeTask(Task $taskModel, string $taskName){
        try{
            $taskModel->task = $taskName;
            if($taskModel->save()) {
             return true;
            }

            return false;

        }catch(Exception $e){
            Logger::error('Exception while saving task', $e->getMessage());
            return false;
        }
        

        
    }


    public function updateTask($id){

    }


}




?>