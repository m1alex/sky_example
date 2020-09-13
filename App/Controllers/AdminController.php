<?php

namespace App\Controllers;

use \Exception;
use Core\Http\BaseController;
use App\ValidationRules\Admin\ProfileUpdate as ProfileUpdateRules;
use App\Models\User;
use Core\Response;

/**
 * @class App\Controllers\AdminController
 *
 * controller for admin pages
 */
class AdminController extends BaseController
{
    /**
          * admin dashboard action
          * 
          * @throws Exception
          */
    public function dashboardAction()
    {
        $currentUserEmail = $this->_auth->currentUser();
        
        if (empty($currentUserEmail)) {
            throw new Exception("You are not logged");
        }
        
        $user = new User();
        $found = $user->findByEmail($currentUserEmail);
        
        if (!$found) {
            throw new Exception("Unknown user");
        }
        
        $placeholders = [
            'username' => $user->username(),
        ];
        
        $template = 'admin.dashboard';
        
        Response::render('admin', $template, $placeholders);
    }
    
    
    /**
          * admin profile action
          * 
          * @throws Exception
          */
    public function profileAction()
    {
        $currentUserEmail = $this->_auth->currentUser();
        
        if (empty($currentUserEmail)) {
            throw new Exception("You are not logged");
        }
        
        $user = new User();
        $found = $user->findByEmail($currentUserEmail);
        
        if (!$found) {
            throw new Exception("Unknown user");
        }
        
        $_SESSION['csrf_token_admin_profile'] = $this->generateCsrfToken();
        
        $placeholders = [
            'csrfToken' => $_SESSION['csrf_token_admin_profile'],
            'username' => $user->username(),
            'email' => $user->email(),
        ];
        $template = 'admin.profile';
        
        Response::render('admin', $template, $placeholders);
    }
    
    
    /**
          * admin profile update action
          * 
          * @throws Exception
          */
    public function profileUpdateAction(array $data)
    {
        $currentUserEmail = $this->_auth->currentUser();
        
        if (empty($currentUserEmail)) {
            throw new Exception("You are not logged");
        }
        
        $user = new User();
        $found = $user->findByEmail($currentUserEmail);
        
        if (!$found) {
            throw new Exception("Unknown user");
        }
        
        $args = $data['args']; // ignore, must be empty
        $params = $data['params'];
        
        $validation = new ProfileUpdateRules();
        $valid = $validation->validate($params);
        
        if (!$valid['valid']) {
            // TODO: processing $valid['errors']
            throw new Exception("Validation error");
        }
        
        // check csrf token
        if (empty($_SESSION['csrf_token_admin_profile'])) {
            throw new Exception("Csrf token error");
        }
        if ($valid['data']['csrf-token'] != $_SESSION['csrf_token_admin_profile']) {
            throw new Exception("Csrf token error");
        }
        unset($_SESSION['csrf_token_admin_profile']);
        
        $user->updateUsername($valid['data']['username']);
        $user->updateEmail($valid['data']['email']);
        
        $this->redirect('/admin/profile');
    }
}
