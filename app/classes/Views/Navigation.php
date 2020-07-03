<?php

namespace App\Views;

use App\App;
use App\User\User;
use Core\View;

class Navigation extends View
{

    public function __construct($data = []) {
        parent::__construct($data);

		$this->addLink('left', '/', 'Shop');

		$user = App::$session->getUser();
        if ($user) {
			$this->addLink('left', '/cart.php', 'Your Cart');
            $this->addLink('right', '/logout.php', "Logout($user->email)");
            $user->role === User::ROLE_ADMIN ? $this->addAdminLinks() : null;
        } else {
            $this->addLink('right', '/login.php', 'Login');
            $this->addLink('right', '/register.php', 'Register');            
        }
    }

    public function addLink($section, $url, $title) {
        $link = ['url' => $url, 'title' => $title];
        
        if ($_SERVER['REQUEST_URI'] === $link['url']) {
            $link['active'] = true;
        }
        
        $this->data[$section][] = $link;
    }

    private function addAdminLinks() {
        $this->addLink('left', '/admin/products/create.php', 'Add Bottle');
        $this->addLink('left', '/admin/products/view.php', 'Manage Bottles');
    }

    public function render($template_path = ROOT . '/app/templates/navbar.php')
    {
        return parent::render($template_path);
    }
}