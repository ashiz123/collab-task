<?php

namespace controllers;

use models\User;
use utils\Logger;
use utils\View;
use services\AuthService;
use services\NotificationService;

class NotificationController {

    public $authService;
    public $notificationService;

    public function __construct()
    {
       $this->authService = AuthService::getInstance();
       $this->notificationService = new NotificationService();
    }

    public function userNotification (){
        $user = User::find($this->authService->getAuthId());
        View::render('/users/notifications.php', 'Notifications', ['notifications' => $user->notifications ]);
    }

    public function notificationReadStatus($noficationId){
    
        $read_at = $_POST['read'];
        ob_clean(); //clear the buffer if the php have return other type of data rather than json before.
         header('Content-Type: application/json');
       
        try{
           if($this->notificationService->read($noficationId, $read_at)){
            
            echo json_encode([
                'success' => true,
                'checked' => true,
                'message' => 'Notification is updated',
                ]);
           }
           
        }

        catch(\Exception $e){
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }

      

       
    }

}