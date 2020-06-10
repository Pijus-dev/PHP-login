<?php
require '../bootloader.php';
require_once ROOT . '/core/classes/FileDB.php';

if (!isset($_SESSION['username'])) {
    header('Location:/login.php');
}

$db = new FileDB(DB_FILE);
$db->load();
$rows = $db->getData();

/**
 * filter_names filters usernames from database
 *
 * @param  mixed $row
 * @return array
 */
function filter_names($rows)
{
    $new_row = [];
    foreach ($rows['sessions'] as $user) {
        if ($user['user'] === $_SESSION['username']) {
            $user['timestamp'] = date('m/d/Y H:i:s', $user['timestamp']);
            $new_row[] = $user;
        }
    }

    return $new_row;
}


$table = [
    'attr' => [
        'class' => 'users-table'
    ],
    'headings' => [
        'Name',
        'Last Time Signed',
        'Session_id'
    ],
    'rows' => filter_names($rows)
];



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bellota:wght@300&family=Lexend+Tera&family=Vollkorn&display=swap">
    <link rel="icon" type="image/png" href="img/logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php require '../core/templates/navbar.php'; ?>
    <div class="users">
        <?php require '../core/templates/table.tpl.php'; ?>
    </div>

    <?php require '../core/templates/footer.php'; ?>