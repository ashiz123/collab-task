<?php

namespace App\Controllers;
use Exception;
use App\Models\Task;
use App\Services\TaskAssignService;
use utils\View;
use utils\Logger;
use App\Services\TaskService;
use App\Services\UserService;


// controller is use to validate and view or response. It works between service and route. 

class TaskController{
    protected $taskService;
    protected $userService;
    protected $taskAssignService;


    public function __construct()
    {
        $this->taskService = new TaskService();
        $this->userService = new UserService();
        $this->taskAssignService = new TaskAssignService();
    }


    public function showAddTaskForm(){
        View::render('tasks/add_task.php', 'task');
    }


    public function showTask($id){
        $task = $this->taskService->getTaskById($id);
        $userOptions = $this->userService->getAllUsers();
        $assignUsers = $this->taskService->getAllUsersByTask($id);
        Logger::info('here' .  $assignUsers);
        View::render('tasks/task.php', 'task', ['task' => $task, 'allUsers' => $userOptions, 'assignUsers' => $assignUsers ]);
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
                header('Location: /tasks');
                exit();
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