<?php


namespace myfrm;

class Validator
{



    protected $errors = [];
    protected $rules_list = ['required', 'min', 'max'];
    protected $messages = [
        'required' => 'Это поле не может быть пустым', 
        'min' => 'Длина :fieldname: должна быть не меньше :rulevalue: символов',
        'max' => 'Длина :fieldname: должна быть не больше :rulevalue: символов',
    ];



    public function validate($data = [], $rules =[])
    {
        foreach ($data as $fieldname => $value) {
            if (isset($rules[$fieldname])) {
                $this->check([
                    'fieldname' => $fieldname,
                    'value' => $value,
                    'rules' => $rules[$fieldname],
                ]);
            }
        }
        return $this;
    }



    protected function check($field)
    {
        foreach ($field['rules'] as $rule => $rule_value) {
            if (in_array($rule, $this->rules_list)) {

                if (!call_user_func_array([$this, $rule], [$field['value'], $rule_value])) {

                    $this->addError($field['fieldname'], str_replace(
                    [':fieldname:', ':rulevalue:'], 
                    [$field['fieldname'], $rule_value],
                     $this->messages[$rule]
                     )

                    );
                }
            }
        }
    }



    protected function addError($fieldname, $error)
    {
        $this->errors[$fieldname][] = $error;
    }



    public function getErrors()
    {
        return $this->errors;
    }



    public function hasErrors()
    {
        return !empty($this->errors);
    }



    public function listErrors($fieldname)
    {
        $output = '';
        if (isset($this->errors[$fieldname])) {
            $output .= "<font color='red'><ul class='list-unstyled'>";
            foreach ($this->errors[$fieldname] as $error) {
                $output .= "<li>{$error}</li>";
            }
            $output .= "</ul></font>";
        }
        return $output;
    }



    protected function required($value, $rule_value)
    {
        return !empty(trim($value));
    }



    protected function min($value, $rule_value)
    {
        return mb_strlen($value, 'UTF-8') >= $rule_value;
    }



    protected function max($value, $rule_value)
    {
        return mb_strlen($value, 'UTF-8') <= $rule_value;
    }
}