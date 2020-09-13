<?php

namespace App\ValidationRules\Auth;

use Core\Http\BaseValidationRule;

/**
 * auth login validation rule
 */
class Login extends BaseValidationRule
{
    protected $_rules = [
        'csrf-token' => 'md5',
        'email'      => 'email',
        'password'   => 'password',
    ];
}
