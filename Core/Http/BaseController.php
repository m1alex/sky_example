<?php

namespace Core\Http;

use \Exception;
use Core\WebApp;

/**
 * Base controller
 * 
 * @class Core\BasicController
 */
abstract class BaseController
{
    /** @var WebApp web application */
    protected $_app;

    /** @var Auth auth*/
    protected $_auth;

    /** @var string */
    protected $_siteUrl;
    

    /**
          * class constructor
          *
          * @param WebApp web application
          */
    function __construct(WebApp $app)
    {
        $this->_app = $app;
        $this->_auth = $app->auth;
        $this->_siteUrl = $app->siteUrl;
    }
    
    
    /**
          * generate csrf token
          * 
          * @return string
          */
    public function generateCsrfToken()
    {
        return md5(time() . rand(1000, 10000));
    }


    /**
          * execute a controller action
          *
          * @param string $action action name
          * @param array $args action arguments
          * @return void void
          * @throws Exception
          */
    public function executeAction($action, $args = [], $params = [])
    {
        if (empty($action)) {
            $action = 'index';
        }
        
        $data = [
            'args' => $args,
            'params' => $params,
        ];
        
        $actionMethod = $this->_dashesToCamelCase(strtolower($action)) . 'Action';
        if (!method_exists($this, $actionMethod)) {
            throw new Exception("Action is not defined = [$action]");
        }

        call_user_func([$this, $actionMethod], $data);
    }
    
    
    /**
          * 
          * @param type $string
          * @param type $capitalizeFirstCharacter
          * @return type
          */
    protected function _dashesToCamelCase($string, $capitalizeFirstCharacter = false) 
    {
        $str = str_replace('-', '', ucwords($string, '-'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }
    
    /**
          * redirect
          *
          * @param string $path path to redirect
          * @param array $args arguments
          * @param array $params parameters
          */
    public function redirect($path = '/', $args = [], $params = [])
    {
        $this->_app->request->redirect($path, $args, $params);
    }
}
