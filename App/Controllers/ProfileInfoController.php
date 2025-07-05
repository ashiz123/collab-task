<?php

namespace App\Controllers;

use App\Models\Skill;
use App\Models\User;
use utils\View;
use App\Services\AuthService;
use utils\Logger;
use utils\FileUpload;
use App\Services\ProfileInfoService;
use App\Services\ProfileService;

class ProfileInfoController {

    public $authService;
    public $fileUpload;
    public $profileInfoService;
    public $profileService;
    public function __construct()
    {
        $this->authService = AuthService::getInstance();
        $this->fileUpload  = new FileUpload($_FILES['avatar'] ?? null);
        $this->profileInfoService = new ProfileInfoService();
        $this->profileService = new ProfileService();
    }

    public function createProfileInfo(){
        $predefinedSkills = Skill::all();
        View::render('/profileInfo/create.php', 'Create Profile Info', ['predefinedSkills' => $predefinedSkills]);
    }

    public function saveProfileInfo(){

        $request = [
            'user_id' => $this->authService->getAuthId(),
            'avatar' => $this->fileUpload->upload(),
            'bio' => $_POST['bio'],
            'date_of_birth' => $_POST['date_of_birth'],
            'phone_number' => $_POST['phone_number'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            'postal_code' => $_POST['postal_code'],
            'website' => $_POST['website'],
            'social_media_links' => $_POST['social_media_links']
        ];

        //validation
        $errors = [];
        if(empty($request['bio'])){
            $errors['bio'] = 'Bio is required.';
        }
        if(empty($request['date_of_birth'])){
            $errors['date_of_birth'] = 'Date of birth is required.';
        }
        if(empty($request['phone_number'])){
            $errors['phone_number'] = 'Phone number is required.';
        }
        if(empty($request['address'])){
            $errors['address'] = 'Address is required.';
        }
        if(empty($request['city'])){                    
            $errors['city'] = 'City is required.';
        }
        if(empty($request['country'])){
            $errors['country'] = 'Country is required.';
        }
        if(empty($request['postal_code'])){
            $errors['postal_code'] = 'Postal code is required.';
        }
        if(empty($request['website'])){               
            $errors['website'] = 'Website is required.';
        }   


        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->profileInfoService->createNewProfileInfo($request);
                $this->profileService->updateProfileInfoStatus($this->authService->getAuthId());
                header('Location: /profile');
                exit;
            } catch(\Exception $e) {
                Logger::error('Failed to create profile: ' . $e->getMessage());
                View::render('/users/create_profile.php', 'Create Profile', [
                    'error' => 'Failed to create profile. Please try again.',
                    'errors' => $errors
                 ]);
            }
        }
       
    }
    
}



