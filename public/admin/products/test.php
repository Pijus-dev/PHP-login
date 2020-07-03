<?php
require '../../../bootloader.php';

use App\Views\Navigation;

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/style/style.css">
    <script src="/js/app.js" type="module"></script>
</head>

<body>
    <?php $nav = new Navigation();
    print $nav->render(); ?>

    <div class="app">
    </div>
</body>

</html>