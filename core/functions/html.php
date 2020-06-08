<?php 
/**
 * form_attrs function generates html form attributes
 *
 * @param  array $attr
 * @return string
 */
function form_attrs($attr): string
{
    $attributes = '';
    foreach ($attr as $key => $value) {
        $attributes .= "$key =\"$value\"";
    }
    return $attributes;
}

/**
 * input_attrs function prints input attributes
 *
 * @param  string $name
 * @param  array $field
 * @return string
 */
function input_attrs(string $name, array $field): string
{
    $attrs = [
        'name' => $name,
        'type' => $field['type'],
        'value' => $field['value'] ?? "",
    ];
    $attrs += $field['extra']['attrs'] ?? [];

    return form_attrs($attrs);
}

/**
 * button_attrs function prints button attributes
 *
 * @param  string $button_id
 * @param  array $button
 * @return string
 */
function button_attrs(string $button_id, array $button): string
{
    $attrs = [
        'name' => 'action',
        'title' => $button['title'],
        'value' => $button_id,
    ];
    $attrs += $button['extra']['attr'] ?? [];

    return form_attrs($attrs);
}

/**
 * Select attributes
 * @param string $select_id
 * @param array $select
 * @return string
 */
function select_attrs($select_id, $select)
{
    $attrs = [
        'name' => $select_id,
        'type' => $select['type']
    ];

    return form_attrs($attrs);
}

/**
 * Get options attributes
 * @param string $option_id
 * @param array $field
 * @return string
 */
function option_attr(string $option_id, array $field): string
{
    $attrs = [
        'value' => $option_id ?? "",
    ];
    if (isset($field['value']) && $field['value'] == $option_id) {
        $attrs['selected'] = true;
    };
    
    return form_attrs($attrs);
}