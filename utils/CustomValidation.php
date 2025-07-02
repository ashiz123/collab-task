<?php

 namespace utils;

 class CustomValidation{

    public function validateRequireField($requests){

        $errors = [];

        foreach($requests as $field => $value){
            if(empty(trim($value))){
               $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        return $errors;

      
    }

 }