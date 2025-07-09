<?php

namespace utils;


class Flash{

    public static function set(string $key,  $value) : void {
         $_SESSION['flash'][$key] = $value;
    }

    public static function get(string $key) {
        if(isset( $_SESSION['flash'][$key])){
        $value = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $value;
        }

        return null;
    }

    public static function has(string $key){
        return isset($_SESSION['flash'][$key]);
    }


}