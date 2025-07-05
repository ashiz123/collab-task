<?php

namespace App\Interfaces;

interface NotificationChannelInterface {
    public function send($userId, $assignId, $title,  $message, $type );
}