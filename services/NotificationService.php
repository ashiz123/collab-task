<?php

namespace services;

use interfaces\NotificationChannelInterface;
use models\Notification;
use utils\Logger;
use interfaces\NotificationInterface;
use services\DatabaseChannelService;

class NotificationService implements NotificationInterface {

 protected static function getChannelHandler($channel){
        return match($channel) {
            'database' => new DatabaseChannelService,
            // 'email' => &todo: create EmailChannelService,
            // 'sms'  => &todo : create SmsChannelService
            default => throw new \InvalidArgumentException("unsupported channel : $channel")
        };

    }

    public static function send($userId, $message, $type='info', $channel = 'database'){
        $handler = self::getChannelHandler($channel);
        $handler->send($userId, $message, $type );
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

