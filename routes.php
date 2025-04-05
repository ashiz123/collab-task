<?php


session_start(); 

use core\Router;
use config\Database;
use utils\View;
use utils\Logger;
use services\AuthService;
use controllers\TaskController;
use controllers\UserController;
use controllers\ContactController;
use utils\AuthMiddleware;

Database::getInstance();

try{
    $taskController = new TaskController();
    $userController = new UserController();
    $contactController = new ContactController();
    $authService = AuthService::getInstance();
    $authMiddleware = new AuthMiddleware($authService);
    $router = new Router();


    //Index Routes
    $router->get('', fn() => View::render('tasks/home.php', 'Home'));
    $router->get('home', fn() => View::render('tasks/home.php', 'Home'));


    //Auth routes
    $router->get('register-user', fn() => View::render('/users/register.php', 'Registration'));
    $router->post('register-user', [$userController, 'register']);
    $router->get('login-user', fn() => View::render('/users/login.php', 'Login'));
    $router->post('login-user', [$userController, 'login']);
    $router->get('logout-user', [$userController, 'logout']);



    //Task Routes
    $router->get('create-task', fn() => $authMiddleware->handle(fn() => $taskController->showAddTaskForm()));
    $router->post('create-task', fn()=> $authMiddleware->handle(fn() => $taskController->createTask()));
    $router->get('tasks', fn() => $authMiddleware->handle(fn() =>  $taskController->showTasks()));


    //Contact Routes
    $router->get('contact', function() {
        View::render('/tasks/contact.php' , 'Contact');
        unset($_SESSION['response']);
    });
    $router->post('contact', [$contactController , 'createContact']);


    $router->get('verify-otp', function() {
        View::render('/users/verifyOtp.php', 'Verify User');
        // unset($_SESSION['register_user']);
    });
    $router->post('verify-otp', [$userController, 'verifyOtp']);
    $router->get('resend-otp', [$userController, 'resendOtp']);


    //Status Routes
    $router->post('update-status/{id}', fn($id) => $authMiddleware->handle(fn() => $taskController->updateStatus($id)));



    $router->matchRoute();

    
}

    
catch(Exception $e){
    error_log('unhandled request' . $e->getMessage());
    http_response_code(500);
    View::render('tasks/500.php', '500 Error');
}





?>