<header>
    <div class="container">
        <img src="app/img/logo.png" alt="">
        <div class="nav">
            <?php if (isset($_SESSION['username']) && isset($_SESSION['password']) == true) : ?>
                <a href="logout.php">LogOut</a>
            <?php else : ?>
                <a href="login.php">Login</a>
                <a href="index.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
</header>