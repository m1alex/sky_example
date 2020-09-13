<?php

namespace App\ValidationRules\Auth;

use Core\Http\BaseValidationRule;

/**
 * auth reset password validation rule
 */
class ResetPassword extends BaseValidationRule
{
    protected $_rules = [
        'csrf-token'          => 'md5',
        'hash'                => 'md5',
        'old-password'        => 'password',
        'new-password'        => 'password',
        'repeat-new-password' => 'password',
    ];
}
