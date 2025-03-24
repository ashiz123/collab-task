<?php

namespace services;

use Exception;
use interfaces\TaskInterface;
use models\Task;
use utils\Logger;
use utils\View;

// service class is to use to access with database

class TaskService implements TaskInterface{

    


    public function allTasks(){
        return Task::orderBy('created_at', 'desc')->limit(10)->get();
       
    }


    public function storeTask(string $taskName, string $description){
        try{
            $newTask = new Task();
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


    public function updateTask($id){

    }


}




?>