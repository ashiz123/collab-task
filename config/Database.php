<?php

namespace config;
use Illuminate\Database\Capsule\Manager as Capsule;
use PDO;
use Dotenv\Dotenv;
use utils\Logger;



class Database{

    private static ?Database $instance = null;
    private Capsule $capsule;

    private function __construct()
    {
        try {
            $rootPath = dirname(__DIR__); 
            $dotenv = Dotenv::createImmutable( $rootPath);
            $dotenv->load();
           

            $this->capsule = new Capsule;
            $this->capsule->addConnection([
                'driver'    => 'mysql',
                'host'      => $_ENV['DB_HOST'],
                'database'  => $_ENV['DB_DATABASE'],
                'username'  => $_ENV['DB_USERNAME'],
                'password'  => $_ENV['DB_PASSWORD'],
                'charset'   => $_ENV['DB_CHARSET'],
                'collation' => $_ENV['DB_COLLATION'],
                'prefix'    => '',
            ], 'default' );
    
           
            $this->capsule->setAsGlobal();
            $this->capsule->bootEloquent();
            $pdo = $this->capsule->getConnection()->getPdo(); //generating pdo instance created by capsule.
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Enabling exceptions on connection failure
    
          
    
        } catch (\Exception $error) {
            
            echo '<h1>Database Connection Error</h1>';
            echo '<p>Unable to connect to the database. Please try again later.</p>';
            echo '<p><strong>Error Details:</strong> ' . htmlspecialchars($error->getMessage()) . '</p>';
            error_log($error->getMessage());
            Logger::error('Database connection failed: ' . $error->getMessage());
    
          
            exit; 
        }
    }


    // Static method to get the Singleton instance 
    public static function getInstance(): Database {
        if(self::$instance === null){
            self::$instance= new Database();
        }

        return self::$instance;
    }


    //getCapsule for running queries
    public function getCapsule() : Capsule {
        return $this->capsule;
    }

}









?>