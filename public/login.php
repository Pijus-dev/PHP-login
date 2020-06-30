<?php
require '../bootloader.php';

use App\App;
use Core\Views\Form;
use App\Views\Navigation;
use App\User\Model;

$data = [
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
function form_success(&$data, $form_values)
{
    $user_data = Model::getWhere(['email' => $form_values['email']]);

    $user = $user_data[0];
    App::$session->login($user->email, $user->password);


    header('Location:/products.php');
}

/**
 * form_fail shows an error message if form returns false
 *
 * @param  array $form
 * @param  array $form_values
 * @return mixed
 */
function form_fail(&$data, $form_values)
{
    $data['error_message'] = 'Failed to login';
}

$view = new Form($data);
$navigation = new Navigation();

$form_values = sanitize_form_values($view->getData());
if ($form_values) {
    validate_form($view->getData(), $form_values);
}

$form_template = $view->render();

require_once  ROOT .  '/core/templates/head.php';
print $navigation->render();

?>

<main>
    <div class="test animate__animated animate__bounceInDown">
        <?php print $form_template; ?>
    </div>
</main>

<?php require  ROOT .  '/core/templates/footer.php'; ?>