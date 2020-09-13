<?php

namespace Core\Validation\Validators;

use Core\Validation\BaseValidator;

/**
 * @class Core\Validation\Validators\EmailValidator
 * 
 * email validator
 */
class EmailValidator extends BaseValidator
{
    public $errorMessage = 'Email is not validated!';
    
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
        if (preg_match("|^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$|i", trim($value))) {
            $valid = true;
        }

        return $valid;
    }
}
