<?php require '../bootloader.php'; 
use App\App;
use App\Pixels\Pixel;
use Core\View;
use App\Views\Navigation;
use App\Pixels\Model;




if (!App::$session->getUser()){
    header('Location: /login.php');
}

$data = [
    'attrs' => [
        'method' => 'POST'
    ],
    'fields' => [
        'x' => [
            'label' => 'X coordinates',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
                'validate_field_is_numeric',
                'validate_field_range' => [
                    'min' => 0,
                    'max' => 500
                ],
                'validate_field_is_numeric'
            ],
            'extra' => [
                'attrs' => [
                    'placeholder' => 'x coordinates'
                ]
            ],
        ],
        'y' => [
            'label' => 'Y coordinates',
            'type' => 'text',
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
                'validate_field_is_numeric',
                'validate_field_range' => [
                    'min' => 0,
                    'max' => 500
                ],
                'validate_field_is_numeric'
            ],
            'extra' => [
                'attrs' => [
                    'placeholder' => 'y coordinates'
                ]
            ],
        ],
        'color' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
            ],
            'type' => 'select',
            'label' => 'Color',
            'value' => 'green',
            'options' => [
                'red' => 'Red',
                'green' => 'Green',
                'brown' => 'Brown',
                '#FFD700' => 'Yellow',
            ]
        ],
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
        'fail' => 'form_fail'
    ],
    'validators' => [
        'coordinate_validator'
    ]
];

function form_success(&$form, $form_values)
{
    $table_name = 'pixels';
    App::$db->createTable($table_name);
    
    $form_values['email'] = $_SESSION['username'];

    $pixel = new Pixel($form_values);

    $pixels = Model::getWhere([
        'x' => $pixel->x,
        'y' => $pixel->y,
    ]);

    if (isset($pixels[key($pixels)])) {
        $pixel->id = $pixels[0]->id;
        Model::update($pixel);
    } else {
        Model::insert($pixel);
    }

    $form['success_message'] = 'You have successfully added your coordinates';
}


function form_fail(&$form, $form_values)
{
}

$view = new View($data);
$form_values = sanitize_form_values($view->getData());
if ($form_values) {
    validate_form($view->getData(), $form_values);

}

$form_template = $view->render(ROOT .  '/core/templates/form.tpl.php');

require ROOT . '/core/templates/head.php';

$navigation = new Navigation();
print $navigation->render();

?>
<main>
    <div class="test">
        <?php print $form_template; ?>
    </div>
</main>

<?php require ROOT . '/core/templates/footer.php'; ?>