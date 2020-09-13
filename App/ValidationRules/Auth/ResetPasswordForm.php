<?php

namespace App\ValidationRules\Auth;

use Core\Http\BaseValidationRule;

/**
 * auth reset validation rule
 */
class ResetPasswordForm extends BaseValidationRule
{
    protected $_rules = [
        'csrf-token' => 'md5',
        'hash'       => 'md5',
    ];
}
