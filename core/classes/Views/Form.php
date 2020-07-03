<?php

namespace Core\Views;

use Core\View;

class Form extends View
{
    public function render($template_path = ROOT . '/core/templates/form.tpl.php')
    {
        return parent::render($template_path);
    }

    public function validate()
    {
        $result = true;

        if (!$this->isSubmitted()) {
            return false;
        }

        foreach ($this->data['fields'] as $field_key => &$field) {

            $field['value'] = $this->getSubmitData()[$field_key];
            foreach ($field['validators'] ?? [] as $validator_key => $validator) {
                // Dinamiskai kvieciam validacijos funkcija
                // pvz.: $validator_function = validate_field_not_empty() funkcijai
                if (is_array($validator)) {
                    $validator_function = $validator_key;
                    $params = $validator;
                } else {
                    $validator_function = $validator;
                }
                $field_is_valid = $validator_function($field['value'], $field, $params ?? null);

                if (!$field_is_valid) {
                    $result = false;
                    break;
                }
            }
        };

        foreach ($this->data['validators'] ?? [] as $key => $validator) {
            if (is_array($validator)) {
                $validator_function = $key;
                $params = $validator;
            } else {
                $validator_function = $validator;
            }
            $form_is_valid = $validator_function($this->getSubmitData(), $this->data, $params ?? null);

            if (!$form_is_valid) {
                $result = false;
                break;
            }
        }

        if ($result) {
            if (isset($this->data['callbacks']['success'])) {
                $success = $this->data['callbacks']['success'];
                $success($this->data, $this->getSubmitData());
            }
        } else {
            if (isset($this->data['callbacks']['success'])) {
                $fail = $this->data['callbacks']['fail'];
                $fail($this->data, $this->getSubmitData());
            }
        }

        return $result;
    }

    public function isSubmitted()
    {
        if ($this->getSubmitData()) {
            return true;
        }

        return false;
    }

    public function getSubmitData($filter = true): ?array
    {
            $field_indexes = array_keys($this->data['fields']);

            $params = [];

            foreach ($field_indexes as $value) {
                $params[$value] =  $filter ? FILTER_SANITIZE_SPECIAL_CHARS : null;
            }

            return  filter_input_array(INPUT_POST, $params);
        
    }
}
