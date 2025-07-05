<?php

namespace  App\Services;

use interfaces\NotificationChannelInterface;
use App\Models\Notification;
use utils\Logger;
use App\Models\User;
use App\Interfaces\NotificationInterface;
use App\Services\DatabaseChannelService;

class NotificationService implements NotificationInterface {

 protected static function getChannelHandler($channel){
        return match($channel) {
            'database' => new DatabaseChannelService,
            // 'email' => &todo: create EmailChannelService,
            // 'sms'  => &todo : create SmsChannelService
            default => throw new \InvalidArgumentException("unsupported channel : $channel")
        };

    }



    public static function send($userId, $assignId, $title, $message, $type='info', $channel = 'database'){
        $handler = self::getChannelHandler($channel);
        $handler->send($userId, $assignId, $title, $message, $type );
        return true;
    }




    public static function read($notificationId, $readAt){

        //its because I am getting null in string.
        if($readAt === 'null'){
            $readAt = null;
        }
        
        $notification = Notification::find($notificationId);
        if(!$notification){
            throw new \Exception('Notification not found');
        }
        $updated = $notification->update([
            'read_at' => $readAt
        ]);

        if(!$updated){
            throw new \Exception('Error updating data');
        }

        return true;
    }



    public function countUnreadNotification(){
        if(isset($_SESSION['auth_user'])){
            $user = User::find($_SESSION['auth_user']['id']);
            return $user->unreadNotificationCount();
         }else{
            throw new \Exception('User not available');
         }
     }


    public static function unread($notificationId){
        //&todo: unread function
    }

    public function getAllNotifications($userId){
         //&todo: getAllNotifications function
    }


    public function autoDeleteNotification(){
         //&todo: autoDeleteNotification function
    }




}



?>

