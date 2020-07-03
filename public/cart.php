<?php
require '../bootloader.php';

use App\Views\Navigation;
use App\Views\Forms\Carts\CartData;
use App\Cart\Items\Model;
use App\Cart\Items\Item;
use App\Views\Forms\DeleteForm;
use Core\Views\Form;

function delete_success(&$form, $form_values)
{
    $item = new Item($form_values);
    Model::delete($item);
}

$delete_form = new DeleteForm();
$delete_form->validate();


require_once  ROOT .  '/core/templates/head.php';

$nav = new Navigation();
$cart_table = new CartData();

print $nav->render();

?>

<main>
    <?php print $cart_table->render(); ?>
</main>

<?php require  ROOT .  '/core/templates/footer.php'; ?>