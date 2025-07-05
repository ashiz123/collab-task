<?php

namespace  App\Services;
use App\Interfaces\ContactInterface;
use utils\Logger;
use App\Models\Contact;

class ContactService implements ContactInterface{

    public function createContact($contactData){
        $contactData = new Contact($contactData);
        if($contactData->save()){
            return true;
        }else{
            return false;
        }

    }

    public function getAllContact(){

    }

    public function deleteContact($id){

    }

    public function deleteAllContact(){
        
    }

}



?>