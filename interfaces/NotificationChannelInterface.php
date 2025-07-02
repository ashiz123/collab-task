<?php

namespace interfaces;

interface NotificationChannelInterface {
    public function send($userId, $assignId, $title,  $message, $type );
}