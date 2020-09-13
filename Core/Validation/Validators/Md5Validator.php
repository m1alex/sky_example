<?php

namespace Core\Validation\Validators;

use Core\Validation\BaseValidator;

/**
 * @class App\Validation\Validators\UsernameValidator
 * 
 * md5 validator
 */
class Md5Validator extends BaseValidator
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
        if (preg_match("|^[a-f0-9]{32}$|i", trim($value))) {
            $valid = true;
        }

        return $valid;
    }
	
} // class UsernameValidator
