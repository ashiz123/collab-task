<?php


namespace core;

use utils\Logger;
use utils\View;

class Router{

    private array $routes = [];

    public function get(string $path, callable $handler){
      $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, callable $handler){
      $this->routes['POST'][$path] = $handler;  
    }

    public function update(string $path, callable $handler){

    }

    public function matchRoute(){
        $requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach($this->routes[$requestMethod] ?? [] as $path => $handler){
            if (preg_match('#^' . preg_replace('/\{(\w+)\}/', '(\d+)', $path) . '$#', $requestUri, $matches)) {
                array_shift($matches); // Remove full match
                return $handler(...$matches);
            }

            if($path === $requestUri){
               return $handler();
            }

        }

        http_response_code(500);
        View::render('tasks/500.php', '500 Error');

    }





}