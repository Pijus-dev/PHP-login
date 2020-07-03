<?php 
define('ROOT', __DIR__);
define('DB_FILE', ROOT . '/app/data/data.json');

// core functions
require ROOT . '/core/functions/validators.php';
require ROOT . '/core/functions/html.php';

// app functions
require ROOT . '/app/functions/validators.php';

// autoload all classes
require ROOT . '/vendor/autoload.php';

$app = new App\App(DB_FILE);


