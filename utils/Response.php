<?php

namespace utils;

class Response{

    public static function send($status, $message, ?array $data = null): void{
        $response =  [
            'status' => $status,
            'message' => $message,
            
        ];

        if($data !== null){
            $response['data'] = $data;
        }

        $_SESSION['response'] = $response;   
    }


}

?>