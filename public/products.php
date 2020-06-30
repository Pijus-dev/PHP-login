<?php
require '../bootloader.php';

use App\Views\Navigation;
use App\Views\CatalogueData;
use App\Views\AddItem;
use App\Cart\Items\Item;
use App\Cart\Items\Model;
use App\App;
use App\Views\Catalogue;

function add_success(&$form, $form_values)
{
    $item = new Item([
        'drink_id' => $form_values['id'],
        'user_id' => App::$session->getUser()->id
    ]);

    Model::insert($item);
    
}

$add_form = new AddItem();

$form_values = sanitize_form_values($add_form->getData());

if ($form_values) {
    validate_form($add_form->getData(), $form_values);
}

$card_view = new CatalogueData();
$nav_view = new Navigation();

require ROOT . '/core/templates/head.php';
print $nav_view->render();

?>

<div class="wrapper animate__animated animate__fadeInUpBig">
    <?php print $card_view->render(); ?>
</div>

<?php require ROOT .  '/core/templates/footer.php'; ?>