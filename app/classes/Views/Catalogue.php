<?php 
namespace App\Views;

use Core\View;

class Catalogue extends View
{
    public function render($template_path = ROOT . '/app/templates/catalog.tpl.php')
    {
        return parent::render($template_path);
    }
}