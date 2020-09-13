<?php

namespace App\Controllers;

use \Exception;
use Core\Http\BaseController;
use Core\Response;

/**
 * @class App\Controllers\SiteController
 *
 * controller for site start page
 */
class SiteController extends BaseController
{
    public function indexAction()
    {
        $placeholders = [];
        
        $template = 'site.index';
        
        Response::render('app', $template, $placeholders);
    }
}
