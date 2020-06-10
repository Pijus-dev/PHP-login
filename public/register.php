<?php
require_once '../bootloader.php';
require_once ROOT . '/core/classes/FileDB.php'; 

$db = new FileDB(DB_FILE);

$form = [
    'attrs' => [
        'method' => 'POST',
        'id' => 'my_id',
        'class' => 'my_class'
    ],
    'fields' => [
        'Name' => [
            'label' => 'Name',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
            ],
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
                'validate_field_password',
                // 'validate_field_length' => [
                //     'min' => 8,
                //     'max' => 16
                // ]
            ]
        ],
        'password_repeat' => [
            'label' => 'Confirm_Password',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
                'validate_field_password',
                // 'validate_field_length' => [
                //     'min' => 8,
                //     'max' => 16
                // ]
            ]
        ]
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
            'password_repeat'
        ],
        'validate_unique_user',
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail',
    ],
    'buttons' => [
        'save' => [
            'title' => 'submit',
            'extra' => [
                'attr' => [
                    'class' => 'btn'
                ]
            ]
        ]
    ]

];



/**
 * form_success shows an success message if everything went well
 *
 * @param  mixed $form
 * @param  mixed $form_values
 * @return void
 */
function form_success(&$form, $form_values)
{
    unset($form_values['password_repeat']);
    $db = new FileDB(DB_FILE);
    $db->load();
    $data = $db->getData();

    $form_values['password'] = password_hash($form_values['password'], PASSWORD_BCRYPT);

    $data['users'][] = $form_values;

    $db->setData($data);
    $db->save();

    $form['success_message'] = 'Successfully registered';
}

/**
 * form_fail shows an error message if form returns false
 *
 * @param  array $form
 * @param  array $form_values
 * @return mixed
 */
function form_fail(&$form, $form_values)
{
    $form['error_message'] = 'Something went wrong';
}


$form_values = sanitize_form_values($form);
if ($form_values) {

    $success =  validate_form($form, $form_values);
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Generator</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bellota:wght@300&family=Lexend+Tera&family=Vollkorn&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="icon" type="image/png" href="img/logo.png" />
    <link rel="stylesheet" href="style/style.css">

</head>

<body>
    <?php require '../core/templates/navbar.php'; ?>
    <main>
        <div class="test animate__animated animate__bounceInDown">
            <?php require '../core/templates/form.tpl.php'; ?>
        </div>
    </main>

    <?php require '../core/templates/footer.php';
