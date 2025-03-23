<?php

namespace utils;

 class View {

    public static function render($contentFile, $pageTitle, $data = []){
        extract($data);
        $contentFile = __DIR__ . '/../views/' . $contentFile;
        require_once __DIR__ . '/../views/layout/master.php';
    }


}




?>