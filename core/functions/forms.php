<?php

/**
 * sanitize_post takes a $_POST array sanitize each input value
 *
 * @param  array $array
 * @return array
 */
function sanitize_post(array $array)
{

    $params = [];
    foreach ($array as $value) {
        $params[$value] = FILTER_SANITIZE_SPECIAL_CHARS;
    }

    return filter_input_array(INPUT_POST, $params);
}

/**
 * sanitize_form_input function  sanitize form inputs
 *
 * @param  array $form
 * @return array
 */
function sanitize_form_values(array $form)
{
    $field_indexes =  array_keys($form['fields']);

    return sanitize_post($field_indexes);
}


/**
 * validate_form function validates form input values from $_POST
 *
 * @param  array $form
 * @param  array $form_values
 * @return boolean
 */
function validate_form(array &$form, array $form_values): bool
{
    $result = true;

    foreach ($form['fields'] as $field_key => &$field) {

        $field['value'] = $form_values[$field_key];
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

    foreach ($form['validators'] ?? [] as $key => $validator) {
        if (is_array($validator)) {
            $validator_function = $key;
            $params = $validator;
        } else {
            $validator_function = $validator;
        }
        $form_is_valid = $validator_function($form_values, $form, $params ?? null);

        if (!$form_is_valid) {
            $result = false;
            break;
        }
    }

    if ($result) {
        if (isset($form['callbacks']['success'])) {
            $success = $form['callbacks']['success'];
            $success($form, $form_values);
        }
    } else {
        if (isset($form['callbacks']['success'])) {
            $fail = $form['callbacks']['fail'];
            $fail($form, $form_values);
        }
    }

    return $result;
}
