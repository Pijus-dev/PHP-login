<?php
require 'bootloader.php';
if (!isset($_SESSION['username'])) {
    header('Location: http://phpsualum:8888/FormTemplates/login.php');
}
is_logged_in();

$row = file_to_array('app/data/data.json')['sessions'] ?? [];

/**
 * filter_names filters usernames from database
 *
 * @param  mixed $row
 * @return array
 */
function filter_names($row)
{
    $new_row = [];
    foreach ($row as $user) {
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
    'rows' => filter_names($row)
];



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bellota:wght@300&family=Lexend+Tera&family=Vollkorn&display=swap">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require 'core/templates/navbar.php'; ?>
    <div class="users">
        <?php require 'core/templates/table.tpl.php'; ?>
    </div>
</body>

</html>