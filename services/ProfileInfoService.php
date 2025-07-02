<?php

namespace services;

use interfaces\ProfileInfoInterface;
use models\ProfileInfo;

class ProfileInfoService implements ProfileInfoInterface{


    public function createNewProfileInfo($formData){
        $createProfile = new ProfileInfo($formData);
        if($createProfile->save()){
            return true;
        }else{
            return false;
        }
    }

    public function updateProfileInfo(){
        
    }

}