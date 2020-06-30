<?php
require '../../../bootloader.php';

use App\Drinks\Model;
use App\Views\Navigation;
use App\Views\Forms\DeleteForm;
use App\App;
use App\User\User;
use App\Views\TableData;
use App\Drinks\Drink;

if(!App::$session->getUser() || App::$session->getUser()->role === User::ROLE_USER) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

function delete_success(&$form, $form_values)
{
    $drinks = new Drink($form_values);
   
     Model::delete($drinks);
}

$delete_form = new DeleteForm();

$form_values = sanitize_form_values($delete_form->getData());

if ($form_values) {
    validate_form($delete_form->getData(), $form_values);
}

require ROOT . '/core/templates/head.php';

$table_data = new TableData();
$table_template = $table_data->render();

$navigation = new Navigation();
print $navigation->render();

?>

<main>
    <div class="users">
        <?php print $table_template; ?>
    </div>
</main>

<?php require ROOT .  '/core/templates/footer.php'; ?>