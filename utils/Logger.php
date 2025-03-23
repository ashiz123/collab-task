<?php

namespace utils;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

class Logger {
    private static $logger;

    public static function getLogger(){
        if(!self :: $logger){
            self::$logger = new MonologLogger('app');
            $logFile = __DIR__ . '/../logs/app.log';
            $logDir = dirname($logFile);

            if(!is_dir($logDir)){
                mkdir($logDir, 0777, true);
            }

            self::$logger->pushHandler(new StreamHandler($logFile, MonologLogger::INFO));
        }
        return self::$logger;
    }


    /**
     * Log an info message
     * @param string $message
     */

     public static function info($message){
        self::getLogger()->info($message);
     }

     /**
      * Log an error message
      * @param string $message
      */

      public static function error($message){
        self::getLogger()->error($message);
      }

      /**
       * Log a warning message
       * @param string message
       */
      public static function warning($message){
        self::getLogger()->warning($message);
      }







}

?>