<?php


use config\Database;
use utils\View;
use utils\Logger;
use controllers\TaskController;
use controllers\UserController;

Database::getInstance();


$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$taskDir = '/views/tasks/';
$userDir = '/views/users/';

try{
    $taskController = new TaskController();
    $userController = new UserController();


    if (preg_match('#^update-status/(\d+)$#', $request, $matches)) {
        $taskId = $matches[1];
        $taskController->updateStatus($taskId);
    }
    else{
        switch($request){

            case '':
                header('Location: /home');
                break;
              
                case 'home' ; 
              View::render('tasks/home.php', 'Home');
              break;
            
        
            case 'create-task':
                if($_SERVER['REQUEST_METHOD'] === 'GET'){
                  $taskController->showAddTaskForm();
                }
                elseIf($_SERVER['REQUEST_METHOD'] === 'POST'){
                  Logger::info('trying to create task');
                  $taskController->createTask('testing only');
                }
                break;
        
                case 'tasks':
                   if($request === 'tasks'){
                   $taskController->showTasks();
                   }
                    break;
        
                case 'register-user':
                    if($_SERVER['REQUEST_METHOD'] === 'GET'){
                      View::render('/users/register.php', 'Registeration');
                        break;
                    }elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
                        $userController->register();
                        break;
                    }


                case 'login-user':
                if($_SERVER['REQUEST_METHOD'] === 'GET'){
                    View::render('/users/login.php', 'Login');
                    break;
                } elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
                    Logger::info($_POST['email']);
                    $userController->login();
                    break;
                }  
                
                case 'logout-user':
                    $userController->logout();
                    break;

                case 'contact': 
                    if($_SERVER['REQUEST_METHOD'] === 'GET') {
                        View::render('/tasks/contact.php' , 'Contact');
                        break;
                    } elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
                        Logger::info('post the contact form');
                        break;
                    }  
                   
                default:    
                    http_response_code(404);
                    require __DIR__ . '/./views/tasks/404.php';
                    break;
        }

    }




}
catch(Exception $e){
    error_log('unhandled request' . $e->getMessage());
    http_response_code(500);
    View::render('tasks/500.php', '500 Error');
}





?>