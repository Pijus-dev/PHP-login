<?php
$url = basename($_SERVER['REQUEST_URI']);
$final_url = rtrim($url, '.php');

if (isset($_SESSION['username'])) {
    $user = App::$db->getRowWhere('users', ['email' => $_SESSION['username']]);
}

?>
<header>
    <div class="container">
        <img class="animate__animated animate__flipInY" src="/img/logo.png" id="logo" alt="logo">
        <div class="nav">
            <?php if (isset($_SESSION['username']) == true) : ?>
                <a href="profile.php">Hi, <?php print $user['name'] ?></a>
                <a href="home.php">Home</a>
                <a href="logout.php">LogOut</a>
            <?php else : ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
</header>
<div class="hero">
    <div class="container animate__animated animate__slideInRight">
        <h1><?php print ucfirst($final_url); ?></h1>
    </div>
</div>