<?php

namespace Core\Validation\Validators;

use Core\Validation\BaseValidator;

/**
 * @class App\Validation\Validators\PasswordValidator
 * 
 * password validator
 */
class PasswordValidator extends BaseValidator
{
    /**
          * validation value
          *
          * @param mixed $value value
          * @return boolean success status
          */
    public function validate($value = null)
    {
        $valid = false;

        // see http://habrahabr.ru/post/123845/		
        if (preg_match("|^[a-zA-Z][a-zA-Z0-9-_\.]{4,16}$|i", trim($value))) {
            $valid = true;
        }

        return $valid;
    }
}