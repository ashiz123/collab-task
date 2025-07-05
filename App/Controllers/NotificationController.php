<?php

namespace App\Controllers;

use App\Models\User;
use utils\Logger;
use utils\View;
use App\Services\AuthService;
use App\Services\NotificationService;

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
        View::render('/notifications/notifications.php', 'Notifications', ['notifications' => $user->notifications ]);
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

    public function getUnreadNotificationCount(){
       
        ob_clean(); 
        header('Content-Type: application/json');
       
        try{
            $count = $this->notificationService->countUnreadNotification();
            echo json_encode(['count' => $count]);
        }
        catch(\Exception $e){
            echo json_encode([
                'success'=> false,
                'message' => 'cannot fetch notifications'. $e->getMessage()
            ]);
        }
    }

}