<?php


session_start(); 

use core\Router;
use config\Database;
use utils\View;

use App\Services\AuthService;
use App\Services\SkillService;
use App\Services\RoleService;

use App\Middlewares\AuthMiddleware;
use App\Middlewares\RoleMiddleware;

use App\Controllers\AdminController;
use App\Controllers\AssignTaskController;
use App\Controllers\TaskController;
use App\Controllers\UserController;
use App\Controllers\ContactController;
use App\Controllers\NotificationController;
use App\Controllers\ProfileController;
use App\Controllers\ProfileInfoController;
use App\Controllers\SkillController;
use App\Middlewares\PermissionMiddleware;

Database::getInstance();

try{
    $taskController = new TaskController();
    $userController = new UserController();
    $notificationController = new NotificationController();
    $contactController = new ContactController();
    $assignTaskController = new AssignTaskController();
    $authService = AuthService::getInstance();
    $authMiddleware = new AuthMiddleware($authService);
    $roleMiddleware = new RoleMiddleware($authService);
    $permissionMiddleware = new PermissionMiddleware($authService);
    $router = new Router(); 
    $profileController = new ProfileController();
    $profileInfoController = new ProfileInfoController();
    $skillService = new SkillService();
    $skillController = new SkillController($skillService);
    $roleService = new RoleService();
    $adminController = new AdminController($roleService);

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
    $router->get('create-task', fn() => $permissionMiddleware->handle(fn() => $taskController->showAddTaskForm(), 'create_task'));
    // $router->get('create-task', fn() => $authMiddleware->handle(fn() => $taskController->showAddTaskForm()));
    $router->post('create-task', fn()=> $authMiddleware->handle(fn() => $taskController->createTask()));
    $router->get('tasks', fn() => $authMiddleware->handle(fn() =>  $taskController->showTasks()));


    //Contact Routes
    $router->get('contact', function() {
        View::render('/tasks/contact.php' , 'Contact');
        unset($_SESSION['response']);
    });
    $router->post('contact', [$contactController , 'createContact']);

    //Profile Info Routes
  
    $router->get('create-profile-info', [$profileInfoController, 'createProfileInfo']);
    $router->post('save-profile-info', [$profileInfoController, 'saveProfileInfo']);

    //Skill Routes
    $router->group('skills', function($router) use ($skillController){
        $router->get('skills', [$skillController, 'index']);
        $router->get('create-skill', [$skillController, 'create']);
        $router->post('store-skill', [$skillController, 'store']);
        $router->get('skill-list', [$skillController, 'skillList']);
    });


    //Profile Routes
    $router->get('profile', [$profileController, 'profilePage']);
   

 
    $router->get('verify-otp', function() {
        View::render('/users/verifyOtp.php', 'Verify User');
        // unset($_SESSION['register_user']);
    });
    $router->post('verify-otp', [$userController, 'verifyOtp']);
    $router->get('resend-otp', [$userController, 'resendOtp']);


    //Status Routes
    $router->post('task/update-status/{id}', fn($id) => $authMiddleware->handle(fn() => $taskController->updateStatus($id)));
    $router->get('task/{id}' , fn($id) => [$taskController->showTask($id)]);

    //task assign routes
    $router->post('assign-task/{id}', fn($id) => $permissionMiddleware->handle(fn() => [$assignTaskController->assignTask($id)], 'assign_task') );
    $router->get('view-assign-task', fn() => $authMiddleware->handle(fn() => $assignTaskController->viewAssignTask()));
    $router->post('assign-task/update-status/{assignId}', fn($assignId) => [$assignTaskController->changeStatus($assignId)]);
    
    //notifications routes
    $router->get('notifications', fn() =>  [$notificationController->userNotification()]);
    $router->post('notifications/{notificationId}', fn($notificationId)=> [$notificationController->notificationReadStatus($notificationId)]);
    $router->get('notifications/unread-count',[$notificationController, 'getUnreadNotificationCount']);

    //admin routes
    $router->get('admin', fn() => $roleMiddleware->handle(fn() => $adminController->index()));
    $router->get('admin/create-role', fn() => $authMiddleware->handle(fn() => $adminController->createRole()));
    // $router->get('admin/roles', fn() => $roleMiddleware->handle(fn()=> $adminController->roles()));
    $router->post('admin/roles', fn() => $roleMiddleware->handle(fn() => $adminController->storeRole()));
    $router->get('admin/role/delete/{id}', fn($id) => $roleMiddleware->handle(fn() => $adminController->deleteRole($id)));
    $router->post('admin/assign-role', fn() => $roleMiddleware->handle(fn()=> $adminController->assignRole()));
    // $router->get('admin/roles', fn() => [$adminController->showAllRoles()]);
    
    $router->matchRoute();

    
} 

    
catch(Exception $e){
    error_log('unhandled request' . $e->getMessage());
    http_response_code(500);
    View::render('tasks/500.php', '500 Error');
}





?>