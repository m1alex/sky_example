<?php

namespace Core;

use \Exception;
use Core\Http\ControllerFactory;
use App\Models\Auth;

/**
 * @class Core\WebApp
 * 
 * web application class
 */
class WebApp
{
    /** @var array */
    public $config;

    /** @var Request */
    public $request;

    /** @var Auth */
    public $auth;

    /** @var string */
    public $siteUtl;
    

    /**
          * class constructor
          */
    function __construct()
    {
        $this->config  = require '../config/app.php';
        $this->auth    = new Auth();
        $this->request = new Request($this->config['routes']);
        $this->siteUrl  = 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/';
    }


    /**
          * processing request
          */
    public function process()
    {
        try {
            list($method, $controller, $action, $args, $params) = $this->request->parse();
        
            if (!$this->request->checkRoute($method, $controller, $action)) {
                throw new Exception("Incorrect route");
            }
        
            $controllerObject = ControllerFactory::createController($controller, $this);
            $controllerObject->executeAction($action, $args, $params);
        } catch (Exception $e) {
            // TODO: logging with $e->getMessage()
            // TODO: redirect to static page... 404, maitenance... stc
            echo 'Sorry, there was an error... ';
        }
    }
}
