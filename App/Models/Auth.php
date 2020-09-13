<?php

namespace App\Models;

use \Exception;
use App\Models\User;

/**
 * auth model
 */
class Auth
{
    protected $_user;
    
    
    /**
          * class constructor
          */
    function __construct()
    {
        $email = $this->currentUser();
         
        if (!empty($email)) {
            $user = new User();
            $user->findByEmail($email);
            
            $this->_user = $user;
        }
    }
    
    
    /**
          * get current user login
          *
          * @return string current user login
          */
    public function currentUser()
    {
        return isset($_SESSION['logged']) ? $_SESSION['logged'] : null;
    }
    
    
    /**
          * login function
          *
          * @param string $login login
          * @return boolean success status
          */
    public function login(string $login)
    {
        return $_SESSION['logged'] = $login;
    }
    
    
    /**
          * logout function
          *
          * @return boolean success status
          */
    public function logout()
    {
        return session_destroy();
    }
}
