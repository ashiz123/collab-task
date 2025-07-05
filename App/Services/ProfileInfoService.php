<?php

namespace  App\Services;

use App\Interfaces\ProfileInfoInterface;
use App\Models\ProfileInfo;

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