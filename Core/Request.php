<?php

namespace Core;

use \Exception;

/**
 * @class Core\Request
 * 
 * web application request class
 */
class Request
{
    /** @var array */
    protected $_routes;
    
    /** @var boolean ajax flag */
    protected $_isAjax = false;

    /** @var string request method */
    protected $_method;

    /** @var string controller name */
    protected $_controller;

    /** @var string action name */
    protected $_action;

    /** @var array arguments */
    protected $_args;
    
    /** @var array parameters */
    protected $_params;


    /**
          * class constructor
          */
    function __construct(array $routes)
    {
        $this->_routes = $routes;
                
        $this->_requestURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->_isAjax = true;
        }

        $this->_method = $_SERVER['REQUEST_METHOD'];
        $this->_params = $_REQUEST;
    }


    /**
         * get request method
         *
         * @return string
         */
    public function getMethod()
    {
        return $this->_method;
    }


    /**
         * is ajax method
         *
         * @return boolean
         */
    public function isAjax()
    {
        return $this->_isAjax;
    }


    /**
          * parsing request
          *
          * @return boolean
          * @throws Exception
          */
    public function parse()
    {
        $this->_controller = '';
        $this->_action     = '';
        $this->_args       = [];
        
        if ($this->_requestURI != '/') {
            $uriParts = explode('/', trim($this->_requestURI, '/'));
            
            if (count($uriParts) % 2) {
                throw new Exception("Incorrect request structure");
            }
            
            $controller = array_shift($uriParts);
            $action     = array_shift($uriParts);

            $args = [];
            for ($i=0; $i < count($uriParts); $i++) {
                $args[$uriParts[$i]] = $uriParts[++$i];
            }
            
            $this->_controller = $controller;
            $this->_action     = $action;
            $this->_args       = $args;
        }
        
        $r = [
            $this->_method,
            $this->_controller,
            $this->_action,
            $this->_args,
            $this->_params,
        ];

        return [
            $this->_method,
            $this->_controller,
            $this->_action,
            $this->_args,
            $this->_params,
        ];
    }
    
    
    /**
          * @param string $method
          * @param string $controller
          * @param string $action
          * @return boolean
          * @throws Exception
          */
    public function checkRoute(string $method, string $controller, string $action)
    {
        if ($controller && $action) {
            $targetRoute = "/$controller/$action";
        } else {
            $targetRoute = '/';
        }
        
        if (empty($this->_routes[$targetRoute])) {
            throw new Exception("Unknown route");
        }
        
        if ($this->_routes[$targetRoute]['method'] != $method) {
            throw new Exception("Unknown request method");
        }
        
        return true;
    }


    /**
          * redirect
          *
          * @param string $path path to redirect
          * @param array $params parameters
          */
    public function redirect(string $path = '/', array $params = [])
    {
        $url = $path . ($params ? '?' . http_build_query($params) : '');

        header("Location: $url");
        exit();
    }
}
