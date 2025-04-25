<?php

namespace interfaces;

interface NotificationChannelInterface {
    public function send($userId, $message, $type );
}