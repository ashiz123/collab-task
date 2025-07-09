<?php

namespace utils;

class Template{

    private static ?Template $instance = null;
    private array $sections = [];
    private ?string $currentSection = null;


    private function __construct()
    {
        //private custructor means it prevents creating new instances outside using new Template();
    }

    public static function getInstance(): Template{
        if(self::$instance === null){
            self::$instance= new Template();
        }

        return self::$instance;
    }

    public function startSection(string $name) : void{
        $this->currentSection = $name;
        ob_start();
    }

    public function endSection() : void{
        if($this->currentSection != null){
        $this->sections[$this->currentSection] = ob_get_clean();
        $this->currentSection = null;
        }
    }


    public function section(string $name): string {
        return $this->sections[$name] ?? '';
    }

    public function includePartial(string $filePath, array $variables = []): void{
        extract($variables);
        include $filePath;
    }
    



    

}