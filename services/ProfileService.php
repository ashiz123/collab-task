<?php

namespace services;

use models\Profile;
use interfaces\ProfileInterface;
class ProfileService implements ProfileInterface {

    public function updateProfileInfoStatus($userId){
       
        $profile = Profile::find($userId);
        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $userId;
        }
        $profile->is_profile_completed = true;
        $profile->save();
    }


    public function updateEducationStatus($userId){
        $profile = Profile::find($userId);
        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $userId;
        }
        $profile->is_education_completed = true;
        $profile->save();
    }

    public function updateSkillStatus($userId){
        $profile = Profile::find($userId);
        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $userId;
        }
        $profile->is_skill_completed = true;
        $profile->save();
    }

    public function updateExperienceStatus($userId){
        $profile = Profile::find($userId);
        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $userId;
        }
        $profile->is_experience_completed = true;
        $profile->save();
    }

    
    
}