<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Services\AuthService;
use App\Services\OtpService;
use utils\Logger;
use utils\View;

class OtpController  extends BaseController{
    
    private $otpService;
    private $authService;

    public function __construct()
    {
        $this->authService = AuthService::getInstance();
        $this->otpService = new OtpService();
    }

    public function verifyOtpForm(): void{
          View::render('/users/verify_otp.php', 'Verify User');
    }



    public function verifyOtp(){
        try{
        
        $otp = $_POST['otp'];
        $user = $this->otpService->verify($otp);

        if($user->is_verified === 0){
            header("Location: /verify-otp?error= user not verified");
        }

        if($user){
            $this->authService->setAuthUser($user);
            header("Location: /home" );
        }else{
            header("Location: /verify-otp?error=Invalid or Expired OTP");
            exit();
        }
        }
        catch(\Exception $e){
            header("Location: /error.php?message= " . urlencode($e->getMessage()));
            exit();
        }
    }





   public function resendOtp(){
    try{
        $email = $_SESSION['register_email'];
        Logger::info($email);
        $user = $this->otpService->update($email);
        Logger::info('user', $user);


        if(!$user){
            $this->setOtpSession('error', "No user found.");
            $this->redirect("/error.php?message=No registered email");
            return;
        }
        
           if($this->otpService->send($user)){
            $this->setOtpSession('success', "OTP send successfully. Please check your email.");
            } else {
            $this->setOtpSession('error', "There is some issue sending OTP. Please report issue.");
            }

            $this->redirect("/verify-otp");
    }
      

        catch(\Exception $e){
            echo 'Error occured' . $e->getMessage();
        }    
      
    }
  

    private function setOtpSession($status, $message){
        $_SESSION['verify_otp'] = array(
            "status" => $status,
            "message" => $message
        );
       
    }


    



}