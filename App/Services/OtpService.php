<?php

namespace App\Services;
use App\Interfaces\OtpInterface;
use App\Models\User;
use config\smtpMailer;
use DateTime;
use Exception;
use utils\Logger;

class OtpService implements OtpInterface {


    private $mailer;
    

    public function __construct(){
        $this->mailer = new smtpMailer();
    }

    public function send(User $user){
        if(!$user){
            throw new \InvalidArgumentException('Authenticated user is not avaialble to send OTP code');
        }

        if(empty($user->otp)){
            throw new \RuntimeException('User does not have OTP to send');
        }

        $subject = "Your OTP Code";
        $message = "<p>Your OTP is: <strong>{$user->otp}</strong>.</p><p>It expires in 10 minutes.</p>";
        return $this->mailer->sendOtpToEmail($user->email, $subject, $message);
    }


   public function verify(string $otp){
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


    
         public function update(string $email){

            if(!$email){
                throw new Exception('Email not found to verify');
            }
            
            $user = User::where('email', $email)->first();
            $updatedUser =  $user->update([
                   'otp' => rand(100000, 999999),
                   'otp_expires' => date("Y-m-d H:i:s", strtotime("+10 minutes"))
                ]);


            if($updatedUser){
                return $user;
            }else{
                return null;
            }    
                
            

           
           
        }

}