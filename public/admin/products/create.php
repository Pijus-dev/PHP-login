<?php
require '../../../bootloader.php';

use App\App;
use App\Drinks\Drink;
use App\Drinks\Model;
use App\Views\Navigation;
use App\Views\Forms\DrinkAddForm;
use App\User\User;

if(!App::$session->getUser() || App::$session->getUser()->role === User::ROLE_USER) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

function form_success(&$form, $form_values)
{
    $table_name = 'products';
    App::$db->createTable($table_name);

    $drink = new Drink($form_values);

    Model::insert($drink);

    $form['success_message'] = 'You have successfully added your product';
}

function form_fail(&$form, $form_values)
{
    $form['error_message'] = 'Failed to add';
}


$view = new DrinkAddForm();

$form_values = sanitize_form_values($view->getData());

if ($form_values) {
    validate_form($view->getData(), $form_values);
}


require ROOT . '/core/templates/head.php';

$add_template = $view->render();

$navigation = new Navigation();
print $navigation->render();

?>
<main>
    <div class="test">
        <?php print $add_template; ?>
    </div>
</main>

<?php require ROOT .  '/core/templates/footer.php'; ?>