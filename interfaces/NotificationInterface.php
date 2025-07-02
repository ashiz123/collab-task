<?php

namespace interfaces;


interface NotificationInterface {


    public static function send($userId, $assignId,$title, $message, $type='info', $channel = 'database');

    public static function read($notificationId, $readAt);

    public static function unread($notificationId);

    public function getAllNotifications($userId);

    public function autoDeleteNotification();
 }




?>