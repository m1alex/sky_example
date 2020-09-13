<?php

namespace Core\Http;

use \Exception;
use Core\WebApp;

/**
 * @class Core\Http\ControllerFactory
 *
 * factory who create validator
 */
class ControllerFactory
{
    /**
          * @param string $controller
          * @param WebApp $app
          * @return class
          * @throws Exception
          */
    public static function createController(string $controller, WebApp $app)
    {
        if (empty($controller)) {
            $controller = 'site';
        }
        
        $controllerName = ucfirst(strtolower($controller)) . 'Controller';
        
        $controllerClass = "\\App\\Controllers\\$controllerName";
        if (!class_exists($controllerClass)) {
            throw new Exception("Controller is not defined = [{$controller}]");
        }

        $controllerObject = new $controllerClass($app);

        return $controllerObject;
    }
}
