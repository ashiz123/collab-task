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
use App\Controllers\RoleController;
use App\Controllers\AssignTaskController;
use App\Controllers\TaskController;
use App\Controllers\UserController;
use App\Controllers\ContactController;
use App\Controllers\NotificationController;
use App\Controllers\OtpController;
use App\Controllers\ProfileController;
use App\Controllers\ProfileInfoController;
use App\Controllers\PermissionController;
use App\Controllers\SkillController;
use App\Middlewares\PermissionMiddleware;
use App\Services\PermissionService;

Database::getInstance();

try{
    $taskController = new TaskController();
    $userController = new UserController();
    $otpController = new OtpController();
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
    $permissionService = new PermissionService();
    $roleController = new RoleController($roleService);
    $permissionController = new PermissionController($permissionService);

    //Index Routes
    $router->get('', fn() => View::render('tasks/home.php', 'Home'));
    $router->get('home', fn() => View::render('tasks/home.php', 'Home'));


    //Auth routes
    $router->get('register-user', fn() => View::render('/users/register.php', 'Registration'));
    $router->post('register-user', [$userController, 'register']);
    $router->get('login-user', fn() => View::render('/users/login.php', 'Login'));
    $router->post('login-user', [$userController, 'login']);
    $router->get('logout-user', [$userController, 'logout']);


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
   
    //protect this route with registered user 
    $router->get('verify-otp', [$otpController, 'verifyOtpForm']);
    $router->post('verify-otp', [$otpController, 'verifyOtp']);
    $router->get('resend-otp', [$otpController, 'resendOtp']);

    //Status Routes
    $router->post('task/update-status/{id}', fn($id) => $authMiddleware->handle(fn() => $taskController->updateStatus($id)));
    $router->get('task/{id}' , fn($id) => [$taskController->showTask($id)]);

    //Task Routes
    $router->get('create-task', fn() => $permissionMiddleware->handle(fn() => $taskController->showAddTaskForm(), 'create-task')); //adding middleware
    $router->post('create-task', fn()=> $authMiddleware->handle(fn() => $taskController->createTask()));
    $router->get('tasks', fn() => $authMiddleware->handle(fn() =>  $taskController->showTasks()));

    //task assign routes
    $router->post('assign-task/{id}', fn($id) => $permissionMiddleware->handle(fn() => [$assignTaskController->assignTask($id)], 'assign-task') );
    $router->get('view-assign-task', fn() => $authMiddleware->handle(fn() => $assignTaskController->viewAssignTask()));
    $router->post('assign-task/update-status/{assignId}', fn($assignId) => [$assignTaskController->changeStatus($assignId)]);
    
    //notifications routes
    $router->get('notifications', fn() =>  [$notificationController->userNotification()]);
    $router->post('notifications/{notificationId}', fn($notificationId)=> [$notificationController->notificationReadStatus($notificationId)]);
    $router->get('notifications/unread-count',[$notificationController, 'getUnreadNotificationCount']);

    //admin routes
    $router->get('admin', fn() => $roleMiddleware->handle(fn() => $roleController->index()));
    
    // $router->get('admin/roles', fn() => $roleMiddleware->handle(fn()=> $roleController->roles()));
    $router->post('admin/roles', fn() => $roleMiddleware->handle(fn() => $roleController->storeRole()));
    $router->post('admin/permissions' , fn() => $roleMiddleware->handle(fn() => $permissionController->store()));
    $router->get('admin/role/delete/{id}', fn($id) => $roleMiddleware->handle(fn() => $roleController->deleteRole($id)));
    $router->post('admin/assign-role', fn() => $roleMiddleware->handle(fn()=> $roleController->assignRole()));
    $router->post('admin/assign-permission', fn() => $roleMiddleware->handle(fn()=> $permissionController->assignPermission()));
    // $router->get('admin/roles', fn() => [$roleController->showAllRoles()]);
    
    $router->matchRoute();
} 

    
catch(Exception $e){
    error_log('unhandled request' . $e->getMessage());
    http_response_code(500);
    View::render('tasks/500.php', '500 Error');
}





?>