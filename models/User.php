<?php

namespace models;
use Illuminate\Database\Eloquent\Model;
use utils\Logger;

class User extends Model{
   protected $table = 'users';
   protected $fillable = ['email', 'firstname', 'lastname', 'password', 'is_verified', 'otp', 'otp_expires'];
   protected $hidden = ['password'];
   public $timestamps = true;


   public function setPasswordAttribute($value){
      $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
   }

   public function checkPassword($password): bool{
      return password_verify($password, $this->password);
      
    }

   public function getPasswordAttribute($value){
      return $value;
   }


   public function verified(){
      return $this->is_verified === 1;
   }
   

   public static function validateRegisterUser($email, $firstname, $lastname, $password) : Array{
      $errors = [];
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $errors[] = "Invalid email format";
      }


      $existingUser = self::where('Email', $email)->first();
      if($existingUser){
         $errors[] = "User already exit";
      }


      if(strlen($password)<6){
         $errors[] = "password length must be at least 6 characters";
      }


      if(empty($firstname)){
         $errors[] = "Firstname is required.";
      }elseif(!is_string($firstname)){
         $errors[] = "Firstname must be string";
      }elseif(strlen($firstname) > 20){
         $errors[] = "Firstname must be less than 20 characters";
      }

      if(empty($lastname)){
         $errors[] = "Lastname is required.";
      }elseif(!is_string($lastname)){
         $errors[] = "Lastname must be string";
      }elseif(strlen($lastname) > 20){
         $errors[] = "Lastname must be less than 20 characters";
      }



      return $errors;


   }


   public static function validateLoginUser($email, $password) : Array {

      var_dump($email);
      $errors = [];
     
     
      if (empty(trim($email))) {
         $errors[] = "Email is required";  
     } 


      if(empty($password)){
         $errors[] = "Password required";
      }

      return $errors;
   }

  

    
    
   }

   ?>