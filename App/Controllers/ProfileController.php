<?php

namespace App\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Services\AuthService;
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