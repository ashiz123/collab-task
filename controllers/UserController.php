<?php
namespace controllers;
use models\User;
use utils\Logger;

// use Respect\Validation\Validator as validation;




class UserController {

    public function register(){
        $email = trim($_POST['email']);
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $password = trim($_POST['password']);

        $errors = User::validateRegisterUser($email, $firstname, $lastname, $password);

       if(empty($errors)){
        $user = new User;
        $user->email = $email;
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->password = $password;
        $user->save();

        echo "Registeration successful";
       }else{
        foreach($errors as $error){
            echo "<p> $error </p>";
        }
       }
    }

    public function login(){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $errors = User::validateLoginUser($email, $password);
       
        if(empty($errors)){
            $user = User::where('email', $email)->first();
           
            if($user && $user->checkPassword($password)){
                session_start();
                session_regenerate_id(true); 
                $_SESSION['auth_user'] =[ 'email' => $user->email, 'firstname' => $user->firstname, 'lastname' => $user->lastname];
                Logger::info('logged in successful'. $user);
                header("Location: /home");
                exit;
            }else{
                $error = "invalid username or password";
                Logger::info('invalid username or password'. $error);
            }
        }


    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        session_start();
        $_SESSION['message'] = "You have logged out successfully";

        header("Location: /home");
        
    }
}



?>