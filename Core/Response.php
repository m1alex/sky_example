<?php

namespace Core;

use \Exception;

/**
 * @class Core\Response
 * 
 * web application response class
 */
class Response
{
    /**
          * json response
          * 
          * @param array $data
          */
    public static function json(array $data)
    {
        echo(json_encode($data));
    }
    
    
    /**
          * html response
          * 
          * @param string $layout
          * @param string $template
          * @param array $data
          */
    public static function render(string $layout, string $template, array $data)
    {
        $paths = explode('.', $template);
        
        $layoutFile = ROOTPATH . 
                DIRECTORY_SEPARATOR . 'App' .
                DIRECTORY_SEPARATOR . "layouts/{$layout}.php";
                
        $templateFile = ROOTPATH . 
                DIRECTORY_SEPARATOR . 'App' .
                DIRECTORY_SEPARATOR . 'templates' .
                DIRECTORY_SEPARATOR . $paths[0] .
                DIRECTORY_SEPARATOR . $paths[1] . '.php';
        
        try {
            extract($data);
        
            ob_start();
            require $templateFile;
            $body = ob_get_clean();
            ob_end_clean();
            
            ob_start();
            require $layoutFile;
            $html = ob_get_clean();
        } catch (Exception $ex) {
            throw new Exception("Template rendering fails");
        }
        
        echo $html;
    }
}
