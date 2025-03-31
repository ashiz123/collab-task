<?php

use services\AuthService;
use utils\Logger;

$authService = AuthService::getInstance();

if($authService->isUserAuthenticated()){
    echo $authService->getAuthUser()['firstname'] . ' logging in';
}else{
    echo 'user not logged in';
}
?>