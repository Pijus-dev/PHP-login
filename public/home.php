<?php
require '../bootloader.php';


if (!is_logged_in()) {
    header('Location:/login.php');
}

/**
 * filter_names filters usernames from database
 *
 * @param  mixed $row
 * @return array
 */
function filter_names()
{
    $rows = App::$db->getRowsWhere('records', ['user' => $_SESSION['username']]);

    convert_time($rows);

    return $rows;
}

/**
 * convert_time function converts time from unix timestamp to local date
 *
 * @param  mixed $rows
 * @return void
 */
function convert_time(&$rows)
{
    foreach ($rows as  &$row) {
        $row['timestamp'] = date('Y-m-d H:i:s', $row['timestamp']);
    }
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
    'rows' => filter_names()
];



?>
<?php require '../core/templates/head.php'; ?>
<?php require '../core/templates/navbar.php'; ?>
<div class="users">
    <?php require '../core/templates/table.tpl.php'; ?>
</div>

<?php require '../core/templates/footer.php'; ?>