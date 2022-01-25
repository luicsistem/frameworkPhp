<?php

namespace App\Http;
require_once __DIR__ . "/../Http/Controllers/HomeController.php";

class Request 
{
    protected $segments = [];
    protected $controller;
    protected $method;

    public function __construct()
    {
        $this->segments = explode('/', $_SERVER['REQUEST_URI']);
   
         $this->setController();
         $this->setMethod();
    }

    public function setController() 
    {
        // $this->controller = empty($this->segments[1])
        $this->controller = empty($this->segments[3])
        ? 'home'
           : $this->segments[3];
    }

    public function setMethod()
    {
        $this->method = empty($this->segments[4])
              ? 'index'
              : $this->segments[4];
    }

    public function getController()
     {
         // home - Home
     $controller = ucfirst($this->controller);
     return "App\Http\Controllers\\{$controller}Controller";
    }

    public function getMethod() 
    {
        return $this->method;
    }

   public function send()
   {
       $controller= $this->getController();
       $method = $this->getMethod();

       if (class_exists($controller)) {
        $controller = new $controller;
    }else{
        $controller = "App\Http\Controllers\Notfoundcontroller";
    }

       $response = call_user_func([
        new $controller,
        $method
       ]);

       $response->send();
   }

}
 
?>