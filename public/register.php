<?php
require_once '../bootloader.php';

use App\App;
use App\User\User;
use Core\Views\Form;
use App\Views\Navigation;

$data = [
    'attrs' => [
        'method' => 'POST',
        'id' => 'my_id',
        'class' => 'my_class'
    ],
    'fields' => [
        'name' => [
            'label' => 'Name',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
            ],
        ],
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
        'password_repeat' => [
            'label' => 'Confirm_Password',
            'type' => 'password',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
                'validate_field_password',
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
function form_success(&$data, $form_values)
{
    $form_values['password'] = password_hash($form_values['password'], PASSWORD_BCRYPT);

    $user = new User($form_values);

    App::$db->createTable('users');
    App::$db->insertRow('users', $user->_getData());

    $form['success_message'] = 'Successfully registered';
}

/**$
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


$view = new Form($data);
$navigation = new Navigation();

$form_values = sanitize_form_values($view->getData());

if ($form_values) {
     validate_form($view->getData(), $form_values);
}

$form_template = $view->render();

require ROOT . '/core/templates/head.php';
print $navigation->render();

?>
<main>
    <div class="test animate__animated animate__bounceInDown">
        <?php print $form_template; ?>
    </div>
</main>

<?php require ROOT . '/core/templates/footer.php'; ?>