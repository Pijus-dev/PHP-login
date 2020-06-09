<?php 
define('ROOT', __DIR__);
define('DB_FILE', ROOT . '/app/data/data.json');

require ROOT . '/core/functions/auth.php';
require ROOT . '/core/functions/file.php';
require ROOT . '/core/functions/validators.php';
require ROOT . '/core/functions/html.php';
require ROOT . '/core/functions/forms.php';
session_start();

