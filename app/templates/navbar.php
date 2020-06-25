<?php

$url = basename($_SERVER['REQUEST_URI']);
$final_url = rtrim($url, '.php');

if (App\App::$session->getUser()) {
    $user = App\App::$db->getRowWhere('users', ['email' => $_SESSION['username']]);
}

?>

<header>
    <div class="container">
        <img class="logo" src="/img/logo.png"  alt="logo">
        <div class="nav">
           <?php if (App\App::$session->getUser()) : ?>
                <a href="profile.php">Hi, <?php print $user['name'] ?></a>
                <a href="home.php">Home</a>
                <a href="add.php">Add</a>
                <a href="pixelWall.php">PixelWall</a>
                <span id="navbar"></span>
                <a href="logout.php">LogOut</a>
            <?php else : ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
                <a href="pixelWall.php">PixelWall</a>
            <?php endif; ?>
        </div>
    </div>
</header>
<div class="hero">
    <div class="container animate__animated animate__slideInRight">
        <h1><?php print ucfirst($final_url); ?></h1>
    </div>
</div>