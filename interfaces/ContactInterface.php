<?php

namespace interfaces;

interface ContactInterface{

    public function createContact($data);

    public function getAllContact();

    public function deleteContact($id);

    public function deleteAllContact();

}


?>