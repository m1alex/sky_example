<?php

namespace App\ValidationRules\Admin;

use Core\Http\BaseValidationRule;

/**
 * admin profile update validation rule
 */
class ProfileUpdate extends BaseValidationRule
{
    protected $_rules = [
        'csrf-token' => 'md5',
        'username'   => 'username',
        'email'      => 'email',
    ];
}
