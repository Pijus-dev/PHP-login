<?php
require '../../../bootloader.php';

use App\Drinks\Drink;
use App\Views\Navigation;
use App\Drinks\Model;
use App\Views\Forms\DrinkEditForm;
use App\App;
use App\User\User;

if(!App::$session->getUser() || App::$session->getUser()->role === User::ROLE_USER) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

function form_success(&$form, $form_values)
{
    $drink = new Drink($form_values);

    $drink->id = $_GET['id'];

    Model::update($drink);

    $form['success_message'] = 'You have successfully updated info';
}

function form_fail(&$form, $form_values)
{
    $form['error_message'] = 'Failed to edit';
}

$drink = Model::find($_GET['id']);
$data = new DrinkEditForm();

fill_form($data->getData(), $drink);


function fill_form(&$form, Drink $drink)
{
    $drink_data = $drink->_getData();
    foreach ($form['fields'] as $field_id => &$field) {
        $field['value'] = $drink_data[$field_id];
    }
}

$form_values = sanitize_form_values($data->getData());

if ($form_values) {
    validate_form($data->getData(), $form_values);
}

// html template starts
$navigation = new Navigation();
require_once  ROOT .  '/core/templates/head.php';
print $navigation->render();

?>
<main>
    <div class="test">
        <?php print $data->render(); ?>
    </div>
</main>
<?php require  ROOT .  '/core/templates/footer.php'; ?>