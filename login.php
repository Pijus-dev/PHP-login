<?php
require 'bootloader.php';

$form = [
    'attrs' => [
        'method' => 'POST',
        'id' => 'my_id',
        'class' => 'my_class'
    ],
    'fields' => [
        'name' => [
            'label' => 'Username',
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
            ]
        ],
    ],
    'validators' => [
        'validate_fields_match' => [
            'password',
        ],
        'validate_login'
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail',
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

/**
 * form_success shows an success message if everything went well
 *
 * @param  mixed $form
 * @param  mixed $form_values
 * @return void
 */
function form_success(&$form, $form_values)
{
    $_SESSION['username'] = $form_values['name'];
    $_SESSION['password'] = $form_values['password'];
    record_session($form_values['name']);
    header('Location: http://phpsualum:8888/FormTemplates/home.php');
}

/**
 * record_session saves session times in the database
 *
 * @param  string $user
 * @return void
 */
function record_session($user)
{
    $data_array = file_to_array('app/data/data.json');
    $data_array['sessions'][] = [
        'user' => $user,
        'timestamp' => strtotime('now'),
        'sess_id' => session_id()
    ];
    array_to_file($data_array, 'app/data/data.json');
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bellota:wght@300&family=Lexend+Tera&family=Vollkorn&display=swap">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require 'core/templates/navbar.php'; ?>
    <main>
        <div class="test">
            <?php require 'core/templates/form.tpl.php'; ?>
        </div>
    </main>
</body>

</html>