<?php

namespace App\ValidationRules\Auth;

use Core\Http\BaseValidationRule;

/**
 * send reset password email validation rule
 */
class SendResetPasswordEmail extends BaseValidationRule
{
    protected $_rules = [
        'csrf-token' => 'md5',
        'email'      => 'email',
    ];
}