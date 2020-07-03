<?php
require '../bootloader.php';

use App\Views\Navigation;
use App\Views\Forms\Carts\CatalogueData;
use App\Views\Forms\Carts\AddItem;
use App\Cart\Items\Item;
use App\Cart\Items\Model;
use App\App;
use Core\Views\Form;

function add_success(&$form, $form_values)
{
    $item = new Item([
        'drink_id' => $form_values['id'],
        'user_id' => App::$session->getUser()->id
    ]);

    Model::insert($item);
    
}

$add_form = new AddItem();

$view = new Form($add_form->getData());
$view->validate();


$card_view = new CatalogueData();
$nav_view = new Navigation();

require ROOT . '/core/templates/head.php';
print $nav_view->render();

?>

<div class="wrapper animate__animated animate__fadeInUpBig">
    <?php print $card_view->render(); ?>
</div>

<?php require ROOT .  '/core/templates/footer.php'; ?>