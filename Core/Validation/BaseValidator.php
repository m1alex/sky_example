<?php

namespace Core\Validation;

/**
 * abstract class Core\Validation\BaseValidator
 *
 * Basic class for Validators
 */
abstract class BaseValidator
{
    public $errorMessage = 'Data is not validated!';
    
    /**
         * abstract public function validate
         *
         * @param mixed $value value
         * @return boolean success status
         */
    abstract public function validate($value = null);
}
