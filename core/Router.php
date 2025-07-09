<?php


namespace core;

use utils\Logger;
use utils\View;

class Router{

    private array $routes = [];
    private string $currentPrefix = '';

    public function get(string $path, callable $handler){
      $fullPath = trim($this->currentPrefix . '/' . trim($path, '/'), '/');
      $this->routes['GET'][$fullPath] = $handler;
  }
  

  //$handler is something that we are calling from another function.
  public function post(string $path, callable $handler){
      $fullPath = trim($this->currentPrefix . '/' . trim($path, '/'), '/');
      $this->routes['POST'][$fullPath] = $handler;
  }

      public function delete(string $path, callable $handler){
        $fullPath = trim($this->currentPrefix . '/' . trim($path, '/'), '/');
        $this->routes['DELETE'][$fullPath] = $handler;
    }

  public function group(string $prefix, callable $callback){
    $previousPrefix = $this->currentPrefix;
    $this->currentPrefix = rtrim($previousPrefix . '/' . trim($prefix, '/'), '/');
    $callback($this); // Pass the router to the closure
    $this->currentPrefix = $previousPrefix; // Reset prefix after group
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