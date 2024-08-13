<?php 
namespace app\support;

use app\traits\Validations;
use Exception;

class Validate
{
    use Validations;

    private $inputsValidation = [];

    private function getParam($validation, $param)
    {
        if(substr_count($validation, ':') === 1)
        {
            [$validation, $param] = explode(':', $validation);
        }

        return [$validation, $param];
    }

    private function validationExist($validation)
    {
        if(!method_exists($this, $validation))
        {
            throw new Exception("O método {$validation} não existe na validação!");
        }
    }

    public function validate(array $validationsFields)
    {
        // $inputsValidation = [];

        foreach ($validationsFields as $field => $validation) 
        {
            
            $havePipes = str_contains($validation, '|');

            if (!$havePipes)
            {
                $param = '';

                [$validation, $param] = $this->getParam($validation, $param);

                //dd($this->getParam($validation, $param));

                $this->validationExist($validation);

                $this->inputsValidation[$field] = $this->$validation($field, $param); 

            }
            
            if($havePipes)
            {
                $validations = explode('|', $validation);
                $param = '';

                $this->multipleValidations($validations, $field, $param);

            }
           
        }
        // dd($this->returnValidation());
        return $this->returnValidation();
    }

    private function multipleValidations($validations, $field, $param)
    {
        foreach ($validations as $validation) {

            [$validation, $param] = $this->getParam($validation, $param);

            $this->validationExist($validation);

            $this->inputsValidation[$field] = $this->$validation($field, $param); 
            
            if($this->inputsValidation[$field] === null)
            {
                break;
            }

            //dd($this->inputsValidation);

            // return $this->inputsValidation[$field];
        }
    }


    private function returnValidation()
    {
        Csrf::validateToken();

        if(in_array(null, $this->inputsValidation, true))
        {
            return null;
        }

        return $this->inputsValidation;
    }
}

?>