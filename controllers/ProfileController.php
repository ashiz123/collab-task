<?php

namespace controllers;

use models\Profile;
use models\User;
use services\AuthService;
use utils\Logger;
use utils\View;

class ProfileController {
    private $authService;
    public $profile;

    public function __construct()
    {
        $this->authService = AuthService::getInstance();
        $this->profile = new Profile();
    }

    public function profilePage(){
        $user = User::find($this->authService->getAuthId());
        $profileInfo = $user->profileInfo;
        $progression = $this->profile->getProgression($user->id);
        Logger::info($progression);
        View::render('/profile/profilePage.php', 'Profile', ['user' => $user, 'profileInfo' => $profileInfo, 'progression' => $progression]);
    }



}