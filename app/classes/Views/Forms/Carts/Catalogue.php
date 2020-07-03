<?php 
namespace App\Views\Forms\Carts;

use Core\View;

class Catalogue extends View
{
    public function render($template_path = ROOT . '/app/templates/catalog.tpl.php')
    {
        return parent::render($template_path);
    }
}