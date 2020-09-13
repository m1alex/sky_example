<?php

namespace Core\Http;

use Core\Validation\ValidatorFactory;

/**
 * base validation rule class
 */
class BaseValidationRule
{
    protected $_rules;
    
    /**
          *  validate date
          *
          * @param array $data
          * @return boolean success status
          */
    public function validate(array $data)
    {
        $valid = false;
        $validatedData = [];
        $validatedErrors = [];

        // validate selected values
        foreach($data as $key => $value)
        {
            if (empty($this->_rules[$key])) {
                continue;
            }
            
            $validationRule = $this->_rules[$key];
            
            $validator = ValidatorFactory::createValidator($validationRule);

            if ($validator->validate($value)) {
                $validatedData[$key] = $value;
            } else {
                $validatedErrors[$key] = $validator->errorMessage;
            }
        }
        
        if (empty($validatedErrors)) {
            $valid = true;
        } else {
            $validatedData = []; 
        }

        return [
            'valid'  => $valid,
            'data'   => $validatedData,
            'errors' => $validatedErrors,
        ];
    }
}
