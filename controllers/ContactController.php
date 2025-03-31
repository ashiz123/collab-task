<?php

namespace controllers;

use Locale;
use models\Contact;
use services\ContactService;
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