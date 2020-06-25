<?php require '../bootloader.php';
use App\App;
use Core\View;
use App\Views\Navigation;

if (!App::$session->getUser()){
    header('Location: /login.php');
}

$name = App::$db->getRowWhere('users', ['email' => $_SESSION['username']]);
$data = [
    'attrs' => [
        'method' => 'POST',
        'id' => 'my_id',
    ],
    'fields' => [
        'name' => [
            'label' => 'Name',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
            ],
            'extra' => [
                'attrs' => [
                    'placeholder' => $name['name']
                ]
            ]
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
            ],
            'extra' => [
                'attrs' => [
                    'placeholder' => $name['email']
                ]
            ]
        ]
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
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail',
    ],
];

$view = new View($data);

$form_values = sanitize_form_values($view->getData());
if ($form_values) {
    
    validate_form($view->getData(), $form_values);

    $user = App::$db->getRowsWhere('users', ['email' => $_SESSION['username']]);

    App::$db->updateRow('users', [
        'name' => $form_values['name'],
        'email' => $form_values['email'],
        'password' => $_SESSION['password']
    ], key($user));

    $person = App::$db->getRowById('users', key($user));
    App::$session->update_session($person['email']);
}

function form_success(&$data, $form_values)
{
    $form['success_message'] = 'You have successfully updated your data';
}

function form_fail(&$data, $form_values)
{
    $form['error_message'] = 'Something went wrong';
}

$form_template = $view->render(ROOT .  '/core/templates/form.tpl.php');

require ROOT . '/core/templates/head.php';
$navigation = new Navigation();
print $navigation->render();

?>

<div class="profile animate__animated animate__bounceInUp">
    <?php print $form_template; ?>
</div>

<?php require ROOT . '/core/templates/footer.php'; ?>