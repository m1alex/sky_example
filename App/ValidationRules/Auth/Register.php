<?php

namespace App\ValidationRules\Auth;

use Core\Http\BaseValidationRule;

/**
 * auth register validation rule
 */
class Register extends BaseValidationRule
{
    protected $_rules = [
        'csrf-token'      => 'md5',
        'username'        => 'username',
        'email'           => 'email',
        'password'        => 'password',
        'repeat-password' => 'password',
    ];
}
