<?php

namespace App\Controllers;

use Locale;
use App\Models\Contact;
use App\Services\ContactService;
use utils\Logger;
use utils\Response;
use utils\View;

class ContactController{
  
    private $contactService;


    public function __construct()
    {
        $this->contactService = new ContactService();
    }



    public function createContact(){
        $contactData = [
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'message'  => $_POST['message'],
        ];
        $errors =  Contact::validateContact($contactData);
        Logger::info(json_encode($errors));
        
        if(empty($errors)){
           if($this->contactService->createContact($contactData)){
            Response::send('success', 'Sending message successful');
        }
        }else{
           Response::send('error', 'Error sending message', $errors, $errors);
        }
           
        header('Location: /contact' );
        exit();
    }


}

?>