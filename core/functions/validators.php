<?php

/**
 * validate_field_not_empty checks if the input is empty or not
 *
 * @param  string $field_value
 * @param  array $field
 * @return bool
 */
function validate_field_not_empty($field_value, &$field)
{
    if (!$field_value ?? '') {
        $field['error'] = 'Please, fill the empty blank';
        return false;
    } else {
        return true;
    }
}

/**
 * validate_field_empty_space checks for the e whitespace in the input field
 *
 * @param  string $field_value
 * @param  array $field
 * @return bool
 */
function validate_field_empty_space($field_value, &$field)
{
    if (preg_match('/\s/', trim($field_value))) {
        $field['error'] = 'input cant have an empty space';
        return false;
    } else {
        return true;
    }
}

/**
 * validate_field_age checks whetever the input value is number
 *
 * @param  string $field_value
 * @param  array $field
 * @return bool
 */
function validate_field_is_numeric($field_value, &$field)
{
    if (is_numeric($field_value)) {
        return true;
    } else {
        $field['error'] = 'Value has to be a number';
    }
}


/**
 * validate_field_range validates if the input value is between given numbers
 *
 * @param  string $field_value
 * @param  array $field
 * @param  array $params
 * @return bool
 */
function validate_field_range($field_value, &$field, $params): bool
{
    $min = $params['min'];
    $max = $params['max'];

    if ($field_value >= $min  &&  $field_value <= $max) {
        return true;
    } else {
        $field['error'] = "Minimum number is $min  and maximum number is $max";
        return false;
    }
}

/**
 * validate_field_password checks if the password starts from capital 
 *
 * @param  string $field_value
 * @param  array $field
 * @return bool
 */
function validate_field_password(string $field_value, array &$field): bool
{

    if (preg_match('/[A-Z]/', $field_value[0])) {
        return true;
    } else {
        $field['error'] = 'First letter has to be capitalized';
        return false;
    }
}

/**
 * validate_field_length checks if the value is at least 8 characters
 *
 * @param  string $field_value
 * @param  string $field
 * @return bool
 */
function validate_field_length(string $field_value, array &$field, $params): bool
{
    $value = strlen($field_value) ?? '';
    if ($value > $params['min'] && $value < $params['max']) {
        return true;
    } else {
        $field['error'] = "Has to be at least {$params['min']} and maximum {$params['max']} characters";
        return false;
    }
}

/**
 * validate_fields_match
 * Checks if form fields match
 * 
 * @param  array $form_fields
 * @param  mixed $field
 * @param  array $params
 * @return bool
 */
function validate_fields_match($form_values, &$form, $params)
{
    $values = [];
    foreach ($params ?? [] as $param) {
        $values[] = $form_values[$param];
    };
    if (count(array_unique($values)) <= 1) {
        return true;
    }

    foreach ($params as $field_id) {
        $form['fields'][$field_id]['error'] = 'Password Does not match';
    }

    return false;
}

/**
 * validate_unique_user checks for unique user in the database
 *
 * @param  array $form_values
 * @param  array $form
 * @return bool
 */
function validate_unique_user(array $form_values, array &$form): bool
{
    $user = App\App::$db->getRowWhere('users', ['email' => $form_values['email']]);

    if ($user) {
        $form['error_message'] = 'User already exists';
        return false;
    }

    return true;
}

/**
 * validate_login checks if the user exists in the database
 *
 * @param  array $form_values
 * @param  array $form
 * @return void
 */
function validate_login($form_values, &$form)
{
    $user = App\App::$db->getRowWhere('users', ['email' => $form_values['email']]);
    if ($user &&  password_verify($form_values['password'], $user['password'])) {
        return true;
    }

    return false;
}



