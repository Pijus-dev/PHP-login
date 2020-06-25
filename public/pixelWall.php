<?php
require '../bootloader.php';
use Core\View;
use App\Views\Navigation;
use Core\Views\Form;

$pixel = App\App::$db->getRowsWhere('pixels', []);

$data = [
    'attr' => [
        'class' => 'pixel',
    ],
    'pixel' => $pixel
];


$view = new View($data);
$navigation = new Navigation();
$form_template = $view->render(ROOT .  '/app/templates/wall.tpl.php');

require_once ROOT . '/core/templates/head.php';  
print $navigation->render();

?>
<main>
    <?php print $form_template; ?>
</main>

<?php require  ROOT . '/core/templates/footer.php';?>
