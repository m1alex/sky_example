<?php

namespace App\Controllers;

use \Exception;
use Core\Http\BaseController;
use App\ValidationRules\Auth\Register as RegisterRules;
use App\ValidationRules\Auth\Activate as ActivateRules;
use App\ValidationRules\Auth\Login as LoginRules;
use App\ValidationRules\Auth\SendResetPasswordEmail as SendResetPasswordEmailRules;
use App\ValidationRules\Auth\ResetPasswordForm as ResetPasswordFormRules;
use App\ValidationRules\Auth\ResetPassword as ResetPasswordRules;
use App\Models\User;
use App\Models\Mail;
use Core\Response;

/**
 * @class App\Controllers\AuthController
 *
 * controller for auth management (register, reset pass, login, logout, change creditionals, etc)
 */
class AuthController extends BaseController
{
    /**
          * auth register form action
          */
    public function registerFormAction()
    {
        $_SESSION['csrf_token_register_form'] = $this->generateCsrfToken();
        
        $placeholders = [
            'csrfToken' => $_SESSION['csrf_token_register_form'],
        ];
        
        $template = 'auth.register-form';
        
        Response::render('app', $template, $placeholders);
    }
    
    
    /**
          * auth register action
          */
    public function registerAction(array $data)
    {
        $args = $data['args']; // ignore, must be empty
        $params = $data['params'];
        
        $validation = new RegisterRules();
        $valid = $validation->validate($params);
        
        if (!$valid['valid']) {
            // TODO: processing $valid['errors']
            throw new Exception("Validation error");
        }
        
        // TODO: make validator
        if ($valid['data']['password'] != $valid['data']['repeat-password']) {
            throw new Exception("Password is not identical");
        }
        
        // check csrf token
        if (empty($_SESSION['csrf_token_register_form'])) {
            throw new Exception("Csrf token error");
        }
        if ($valid['data']['csrf-token'] != $_SESSION['csrf_token_register_form']) {
            throw new Exception("Csrf token error");
        }
        unset($_SESSION['csrf_token_register_form']);
        
        $user = new User();
        $result = $user->create($valid['data']);
        
        if (!$result) {
            throw new Exception("Registration error");
        }
        
        $hash = $user->initActivation();
        
        $to = $valid['data']['email'];
        $subject = 'SkySilk example - register email';
        $template = 'emails.register-email';
        $placeholders = [
            'activateUrl' => $this->_siteUrl . 'auth/activate?hash=' . $hash,
        ];
        
        Mail::send($to, $user->username(), $subject, $template, $placeholders);
        
        $this->redirect('/auth/login-form');
    }
    
    
    /**
          * activate action for user controller
          */
    public function activateAction(array $data)
    {
        $args = $data['args']; // ignore, must be empty
        $params = $data['params'];
        
        $validation = new ActivateRules();
        $valid = $validation->validate($params);
        
        if (!$valid['valid']) {
            // TODO: processing $valid['errors']
            throw new Exception("Validation error");
        }
        
        $user = new User();
        $activated = $user->activate($valid['data']['hash']);
        
        if (!$activated) {
            throw new Exception("Activation error");
        }
        
        $this->redirect('/auth/login-form');
    }
    
    
    /**
          * auth forgot paswword form action
          */
    public function forgotPasswordFormAction()
    {
        $_SESSION['csrf_token_forgot_password_form'] = $this->generateCsrfToken();
        
        $placeholders = [
            'csrfToken' => $_SESSION['csrf_token_forgot_password_form'],
        ];
        
        $template = 'auth.forgot-password-form';
        
        Response::render('app', $template, $placeholders);
    }
    
    
    /**
          * auth send eset password email action for user controller
          */
    public function sendResetPasswordEmailAction(array $data)
    {
        $args = $data['args']; // ignore, must be empty
        $params = $data['params'];
        
        $validation = new SendResetPasswordEmailRules();
        $valid = $validation->validate($params);
        
        if (!$valid['valid']) {
            // TODO: processing $valid['errors']
            throw new Exception("Validation error");
        }
        
        // check csrf token
        if (empty($_SESSION['csrf_token_forgot_password_form'])) {
            throw new Exception("Csrf token error");
        }
        if ($valid['data']['csrf-token'] != $_SESSION['csrf_token_forgot_password_form']) {
            throw new Exception("Csrf token error");
        }
        unset($_SESSION['csrf_token_forgot_password_form']);
        
        $user = new User();
        $found = $user->findByEmail($valid['data']['email']);
        
        if (!$found) {
            throw new Exception("Unknown user");
        }
        
        if (!$user->isActive()) {
            throw new Exception("Inactive user");
        }
        
        $hash = $user->initResetPassword();
        
        $to = $valid['data']['email'];
        $subject = 'SkySilk example - send reset password email';
        $template = 'emails.send-reset-password-email';
        $placeholders = [
            'resetLink' => $this->_siteUrl . 'auth/reset-password-form?hash=' . $hash,
        ];
        
        Mail::send($to, $user->username(), $subject, $template, $placeholders);
        
        $this->redirect('/auth/login-form');
    }
    
    
    /**
          * auth reset password form action for user controller
          */
    public function resetPasswordFormAction(array $data)
    {
        $args = $data['args']; // ignore, must be empty
        $params = $data['params'];
        
        $validation = new ResetPasswordFormRules();
        $valid = $validation->validate($params);
        
        if (!$valid['valid']) {
            // TODO: processing $valid['errors']
            throw new Exception("Validation error");
        }
        
        $_SESSION['csrf_token_reset_password_form'] = $this->generateCsrfToken();
        
        $placeholders = [
            'csrfToken' => $_SESSION['csrf_token_reset_password_form'],
            'hash' => $valid['data']['hash'],
        ];
        
        $template = 'auth.reset-password-form';
        
        Response::render('app', $template, $placeholders);
    }
    
    
    /**
          * auth reset password action for user controller
          */
    public function resetPasswordAction(array $data)
    {
        $args = $data['args']; // ignore, must be empty
        $params = $data['params'];
        
        $validation = new ResetPasswordRules();
        $valid = $validation->validate($params);
        
        if (!$valid['valid']) {
            // TODO: processing $valid['errors']
            throw new Exception("Validation error");
        }
        
        // check csrf token
        if (empty($_SESSION['csrf_token_reset_password_form'])) {
            throw new Exception("Csrf token error");
        }
        if ($valid['data']['csrf-token'] != $_SESSION['csrf_token_reset_password_form']) {
            throw new Exception("Csrf token error");
        }
        unset($_SESSION['csrf_token_reset_password_form']);
        
        // TODO: make validator
        if ($valid['data']['old-password'] == $valid['data']['new-password']) {
            throw new Exception("New password is identical to old password");
        }
        
        // TODO: make validator
        if ($valid['data']['new-password'] != $valid['data']['repeat-new-password']) {
            throw new Exception("New password is not identical");
        }
        
        $user = new User();
        $reset = $user->resetPassword($valid['data']['hash'], $valid['data']['old-password'], $valid['data']['new-password']);
        
        if (!$reset) {
            throw new Exception("Reset password error");
        }
        
        $to = $user->email();
        $subject = 'SkySilk example - password has just reset';
        $template = 'emails.reset-password-email';
        $placeholders = [
            'loginUrl' => $this->_siteUrl . 'auth/login-form',
        ];
        
        Mail::send($to, $user->username(), $subject, $template, $placeholders);
        
        $this->redirect('/auth/login-form');
    }
    
    
    /**
          * auth login form action for user controller
          */
    public function loginFormAction()
    {
        $_SESSION['csrf_token_login_form'] = $this->generateCsrfToken();
        
        $placeholders = [
            'csrfToken' => $_SESSION['csrf_token_login_form'],
        ];
        
        $template = 'auth.login-form';
        
        Response::render('app', $template, $placeholders);
    }
    
    
    /**
          * auth login action for user controller
          */
    public function loginAction(array $data)
    {
        $args = $data['args']; // ignore, must be empty
        $params = $data['params'];
        
        $validation = new LoginRules();
        $valid = $validation->validate($params);
        
        if (!$valid['valid']) {
            // TODO: processing $valid['errors']
            throw new Exception("Validation error");
        }
        
        // check csrf token
        if (empty($_SESSION['csrf_token_login_form'])) {
            throw new Exception("Csrf token error");
        }
        if ($valid['data']['csrf-token'] != $_SESSION['csrf_token_login_form']) {
            throw new Exception("Csrf token error");
        }
        unset($_SESSION['csrf_token_login_form']);
        
        $user = new User();
        $found = $user->findByEmail($valid['data']['email']);
        
        if (!$found) {
            throw new Exception("Unknown user");
        }
        
        if (!$user->checkPass($valid['data']['password'])) {
            throw new Exception("Incorrect password");
        }
        
        if (!$user->isActive()) {
            throw new Exception("Inactive user");
        }
        
        $this->_auth->login($valid['data']['email']);
        
        $this->redirect('/admin/dashboard');
    }


    /**
          *  auth logout action
          */
    public function logoutAction()
    {
        $this->_auth->logout();
        $this->redirect('/');
    }
}
