<?php


session_start(); 


use config\Database;
use utils\View;
use utils\Logger;
use services\AuthService;
use controllers\TaskController;
use controllers\UserController;
use controllers\ContactController;


Database::getInstance();


$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$taskDir = '/views/tasks/';
$userDir = '/views/users/';

try{
    $taskController = new TaskController();
    $userController = new UserController();
    $contactController = new ContactController();
    $authService = AuthService::getInstance();


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
               
                if($authService->isUserAuthenticated()){
                    if($_SERVER['REQUEST_METHOD'] === 'GET'){
                        $taskController->showAddTaskForm();
                      }
                      elseIf($_SERVER['REQUEST_METHOD'] === 'POST'){
                        Logger::info('trying to create task');
                        $taskController->createTask('testing only');
                      }
                }else{
                    echo 'user not authenticated';
                }
                    
                break;
        
                case 'tasks':
                    if($authService->isUserAuthenticated()){
                   if($request === 'tasks'){
                   $taskController->showTasks();
                   }
                }else{
                    echo 'User not authenticated';
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
                    $userController->login();
                    break;
                }  
                
                case 'logout-user':
                    $userController->logout();
                    break;

                case 'contact': 
                    if($_SERVER['REQUEST_METHOD'] === 'GET') {
                         View::render('/tasks/contact.php' , 'Contact');
                         unset($_SESSION['response']);
                        break;
                    } elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
                        $contactController->createContact();
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