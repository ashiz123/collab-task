<?php

namespace App\Interfaces;

interface ContactInterface{

    public function createContact($data);

    public function getAllContact();

    public function deleteContact($id);

    public function deleteAllContact();

}


?>