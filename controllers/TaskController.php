<?php

namespace controllers;
use Exception;
use Illuminate\Container\Attributes\Tag;
use models\Task;
use utils\View;
use utils\Logger;
use services\TaskService;

// controller is use to validate and view or response. It works between service and route. 

class TaskController{
    private $taskModel;
    protected $taskService;


    public function __construct()
    {
        $this->taskModel = new Task();  
        $this->taskService = new TaskService();
    }


    public function showAddTaskForm(){
        View::render('tasks/add_task.php', 'task');
    }



    public function showTasks(){
        $tasks = $this->taskService->allTasks();
        View::render('tasks/tasks.php', 'Tasks', ['tasks' => $tasks]);
    }

 

    public function createTask(){

       //validation
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            View::render('tasks/add_task.php', 'Add Task');

        }   

        $taskName = $_POST['task'] ?? '';
        $description = $_POST['description'] ?? '';


        if(empty($taskName)) {
                View::render('tasks/add_task.php', 'Add Task', ['error' => 'Task name cannot be empty']);
                return;
            }
            if(empty($description)){
                View::render('tasks/add_task.php', 'Add Task', ['error' => "Description cannot be empty"]);
            }

        
            if($this->taskService->storeTask($taskName, $description))
            {
                $tasks = $this->taskService->allTasks();
                View::render('tasks/tasks.php', 'Tasks', ['tasks' => $tasks]);
                return;
            }else{
                View::render('tasks/add_task.php', 'Add Task', ['error' => 'Failed to save task']);
            }
            
        }






    public function updateStatus($id){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        try{
            $task = Task::findOrFail($id);
            $newStatus = $task->status === 'pending' ? 'completed' : 'pending';
            $task->status = $newStatus;
            $task->save();
            Logger::info("Task $id status updated to $newStatus");
            header('Location: /tasks');
            exit();
        }
        catch(\Exception $e){
            Logger::error("Failed to update task $id status: " . $e->getMessage());
            header('Location: /tasks'); 
            exit;
        }
    }
       

    }


}

?>