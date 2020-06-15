<?php
require '../bootloader.php';

$form = [
    'attrs' => [
        'method' => 'POST',
        'id' => 'my_id',
        'class' => 'my_class'
    ],
    'fields' => [
        'email' => [
            'label' => 'Email',
            'type' => 'email',
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
    $user = App::$db->getRowWhere('users', ['email' => $form_values['email']]);
    $_SESSION['username'] = $user['email'];
    $_SESSION['password'] = $user['password'];

    record_session($form_values['email']);
    header('Location:/home.php');
}

/**
 * record_session saves session times in the database
 *
 * @param  string $user
 * @return void
 */
function record_session($user)
{
    App::$db->createTable('records');
    App::$db->insertRow('records', [
        'user' => $user,
        'timestamp' => strtotime('now'),
        'sess_id' => session_id()
    ]);
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
    $form['error_message'] = 'Failed to login';
}

$form_values = sanitize_form_values($form);
if ($form_values) {

    $success =  validate_form($form, $form_values);
}
?>
<?php require '../core/templates/head.php'; ?>
    <?php require '../core/templates/navbar.php'; ?>
    <main>
        <div class="test animate__animated animate__bounceInDown">
            <?php require '../core/templates/form.tpl.php'; ?>
        </div>
    </main>



    <?php require '../core/templates/footer.php';
