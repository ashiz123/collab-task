<?php

namespace services;
use interfaces\NotificationChannelInterface;
use models\Notification;
use utils\Logger;

class DatabaseChannelService implements NotificationChannelInterface{

    public function send($userId, $message, $type){
        $notification =  Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'message' => $message,
            'read_at' => null
        ]);

        if(!$notification){
            Logger::error('Failed to create notification' );
            throw new \Exception('Failed to create notification');
        }

    }

}





?>