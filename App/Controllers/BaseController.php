<?php


namespace App\Controllers;


class BaseController {

    protected function redirect(string $url) : void {
        header("Location: $url");
        exit;
    }


  

}