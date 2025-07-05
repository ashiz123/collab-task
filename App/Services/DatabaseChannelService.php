<?php

namespace  App\Services;
use App\Interfaces\NotificationChannelInterface;
use App\Models\Notification;
use utils\Logger;

class DatabaseChannelService implements NotificationChannelInterface{

    public function send($userId, $assignId, $title , $message, $type){
        $notification =  Notification::create([
            'user_id' => $userId,
            'assign_id' => $assignId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'read_at' => null
        ]);

        if(!$notification){
            Logger::error('Failed to create notification' );
            throw new \Exception('Failed to create notification');
        }

    }

}





?>