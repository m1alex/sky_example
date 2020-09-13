<?php

namespace Core\Validation;

use \Exception;
use Core\Validation\Validators\UsernameValidator;
use Core\Validation\Validators\EmailValidator;
use Core\Validation\Validators\PasswordValidator;
use Core\Validation\Validators\Md5Validator;

/**
 * @class Core\Validation\ValidatorFactory
 *
 * factory who create validator
 */
class ValidatorFactory
{
    /**
          * 
          * @param string $validator
          * @return \Core\Validation\class
          * @throws Exception
          */
    public static function createValidator(string $validator)
    {
        if (empty($validator)) {
            throw new Exception("Incorrect validator");
        }

        if (!is_string($validator)) {
            throw new Exception("Incorrect validator");
        }
        
        $validatorClass = "\\Core\\Validation\\Validators\\".ucfirst($validator)."Validator";
        if (!class_exists($validatorClass)) {
            throw new Exception("Unknown validator = [{$validator}]");
        }

        $validatorObject = new $validatorClass();

        return $validatorObject;
    }
}
