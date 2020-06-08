<?php
require 'bootloader.php';

$form = [
    'attrs' => [
        'method' => 'POST',
        'id' => 'my_id',
        'class' => 'my_class'
    ],
    'fields' => [
        'Dish' => [
            'label' => 'Dish',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
            ],
        ],
        'Price' => [
            'label' => 'Price',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
                'validate_field_is_numeric',
            ],
        ],
    ],
    'buttons' => [
        'save' => [
            'title' => 'check',
            'extra' => [
                'attr' => [
                    'class' => 'btn'
                ]
            ]
        ]
    ]
];

$form_values = sanitize_form_values($form);
if ($form_values) {

    $success =  validate_form($form, $form_values);
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form <?php print form_attrs($form['attrs'] ?? []); ?>>
        <?php foreach ($form['fields'] ?? [] as $field_id => $field) : ?>
            <?php if (isset($field['label'])) : ?>
                <label><?php print $field['label']; ?></label>
            <?php endif; ?>
            <!--Input tag generation-->
            <input <?php print input_attrs($field_id, $field) ?>>
            <!-- Field error generation-->
            <?php if (isset($field['error'])) : ?>
                <div class="error"><?php print $field['error']; ?></div>
            <?php endif; ?>
        <?php endforeach; ?>
        <!--Field generation end-->

        <!--Button generation start-->
        <?php foreach ($form['buttons'] ?? [] as $button_id => $button) : ?>
            <button <?php print button_attrs($button_id, $button) ?>>
                <?php print $button['title']; ?>
            </button>
        <?php endforeach; ?>
    </form>
</body>

</html>