<?php

namespace App\ValidationRules\Auth;

use Core\Http\BaseValidationRule;

/**
 * auth activate validation rule
 */
class Activate extends BaseValidationRule
{
    protected $_rules = [
        'hash' => 'md5',
        'email' => 'email',
    ];
}
