<?php

namespace App\Interfaces;

interface ProfileInterface{
    

    public function updateProfileInfoStatus($userId);
    public function updateEducationStatus($userId);
    public function updateSkillStatus($userId);
    public function updateExperienceStatus($userId);

    

    

}