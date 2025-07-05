<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model {
    protected $table = 'contact';
    protected $primary = 'id';
    protected $fillable = ['name', 'email', 'phone', 'message' ];


    public static function validateContact($contact){
        $errors = [];
        if (empty($contact['name'])){
            $errors['name'] = "Contact name is required";
        }elseif (!is_string($contact['name'])){
            $errors['name'] = "Contact name must be string";
        }elseif (strlen($contact['name']) < 5){
            $errors['name'] = "Contact name length must be greater than 5 character";
        }

        if(!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Invalid email format";
        }


        if(empty($contact['phone'])){
            $errors['phone'] = "Phone number is required";
        }else if(!is_numeric($contact['phone'])){
            $errors['phone'] = "Phone number must be number";
        }

        if(empty($contact['message'])){
            $errors['message'] = "Message is required";
        }


        return $errors;


    }


}


?>