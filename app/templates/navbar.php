<?php
use App\User\Model;

$url = basename($_SERVER['REQUEST_URI']);
$title = preg_replace('/\.php.*/', '', $url);

if (App\App::$session->getUser()) {
    $user = App\App::$db->getRowWhere('users', ['email' => $_SESSION['username']]);
};

?>

<header>
    <div class="container">
        <img class="logo" src="/img/logo.png"  alt="logo">
        <div class="nav">
           <?php if (App\App::$session->getUser()) : ?>
                <a href="/profile.php">Hi, <?php print $user['name']; ?></a>
                <a href="/admin/products/create.php">Add</a>
                <a href="/admin/products/view.php">View</a>
                <a href="/products.php">Products</a>
                <a href="/cart.php">Cart</a>
                <a href="/logout.php">LogOut</a>
            <?php else : ?>
                <a href="/products.php">Products</a>
                <a href="/login.php">Login</a>
                <a href="/register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
</header>
<div class="hero">
    <div class="container animate__animated animate__slideInRight">
        <h1><?php print ucfirst($title); ?></h1>
    </div>
</div>