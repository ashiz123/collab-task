<?php

namespace utils;


class Flash{

    public static function set(string $key,  $value) : void {
         $_SESSION[$key] = $value;
    }

    public static function get(string $key) {
        $value = $_SESSION[$key] ?? null;
        unset($_SESSION[$key]);
        return $value;
    }


}