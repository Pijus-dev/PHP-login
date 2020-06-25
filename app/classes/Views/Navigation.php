<?php

namespace App\Views;

use Core\View;

class Navigation extends View
{
    public function render($template_path = ROOT . '/app/templates/navbar.php')
    {
        return parent::render($template_path);
    }
}