<?php


namespace services;

use Exception;
use interfaces\AuthInterface;
use interfaces\UserInterface;
use utils\Logger;
use config\smtpMailer;
use DateTime;
use Models\User;

require_once __DIR__ . '/../models/User.php';


class UserService implements UserInterface{
   private $mailer;


    public function __construct()
    {
        $this->mailer = new smtpMailer();
       
    }

    

    public function registerUser($email, $firstname, $lastname, $password): bool
    {
    try {
       
        $user = $this->createUser($email, $firstname, $lastname, $password);
        if (!$user) {
            Logger::error('creating user failed');
            return false;   
        }   

        if($this->sendOtp($user) === false){
            Logger::error("OTP email sending failed for email: " . $user->email);
            return false;
        } 

        return true;

       }   catch (Exception $e) {
                Logger::error('User registration failed: ' . $e->getMessage());
                echo 'Error: ' . $e->getMessage();
                return false;
            }
        }



        public function createUser($email, $firstname, $lastname, $password){
            $user = new User;
            $user->email = $email;
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->password = $password;
            $user->otp = rand(100000, 999999);
            $user->otp_expires = date("Y-m-d H:i:s", strtotime("+10 minutes")); 
            return $user->save() ? $user : null; 

        }


      



        public function updateUserOtp($email){

            
            if($email){
                $user = User::where('email', $email)->first();
                $updateOtp = $user->update([
                   'otp' => rand(100000, 999999),
                   'otp_expires' => date("Y-m-d H:i:s", strtotime("+10 minutes"))
                ]);
                
                if($updateOtp){
                    return $user;
                }
                
                return null;
            }

            return null;
           
        }


        public function sendOtp(User $user){
            $subject = "Your OTP Code";
            $message = "<p>Your OTP is: <strong>{$user->otp}</strong>.</p><p>It expires in 10 minutes.</p>";
            return $this->mailer->sendOtpToEmail($user->email, $subject, $message);
        }


        public function verifyOtp($otp){
            
           
            try{
                $email = $_SESSION['register_email'];
                $user = User::where('email', $email)->first();
               
                if(!$user){
                    return null;
                }

                if ($user->is_verified == 1) {
                    error_log("User already verified: " . $email);
                    Logger::error('User already verified');
                    return null;
                }

               
               if(!hash_equals($user->otp, $otp)){
                    return null;
                }

                if($user->otp_expires){
                    $currentTime = new DateTime();
                    $expiryTime = new DateTime($user->otp_expires);

                    if($currentTime > $expiryTime){
                        return null;
                    }
                }

                Logger::info($user->update(['is_verified' => 1]));

                if ($user->update(['is_verified' => 1])) {
                    return $user; 
                }
                
                return null;   
                
            
            }
            catch(Exception $e){
                throw new \Exception('Error verifying OTP: ' . $e->getMessage());
            }
            
        }

       

        public function loginUser($email, $password){
           
        $user = User::where('email', $email)->first();
        
        if(!$user || !$user->checkPassword($password)){
           throw new Exception("Credentials did not match");
        }

        if(!$user->verified()){
            return ['status' => 'unverified', 'message' => 'Account not verified . Please check email to verify'];
        }

        return $user;
    }



        public function getAllUsers(){
            $users = User::all();
            return $users;
        }


        public function getTasksByUser(){
            $authId = $_SESSION['auth_user']['id'];
            $user = User::find($authId);
            $assignTask = $user->assignedTasks()->with('createdUser')->get();
            return $assignTask;

        }



    
   

    

   

   




}







?>