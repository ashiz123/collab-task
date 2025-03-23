<?php

//  this class is use if need binding for interface to repository

namespace config;

use Exception;

class container{

    protected $bindings = [];

    public function bind($key, $ressolver){
        $this->bindings[$key] = $ressolver;
    }

    public function resolve($key){
        if(!isset($this->bindings[$key])){
            throw new Exception("No binding found for {$key}");
        }

        return call_user_func($this->bindings[$key]);
    }



    


}



?>