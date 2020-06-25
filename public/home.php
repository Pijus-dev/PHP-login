<?php
require '../bootloader.php';
use App\App;
use App\Views\Navigation;
use App\Pixels\Model;

$pixel = Model::getWhere([])[0];
var_dump($pixel);

var_dump($pixel->id);


if (!App::$session->getUser()){
    var_dump(App::$session->getUser());
    header('Location: /login.php');
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

require ROOT .  '/core/templates/head.php';
$navigation = new Navigation();
print $navigation->render();

?>

<div class="users">
    <?php require ROOT .  '/core/templates/table.tpl.php'; ?>
</div>

<?php require ROOT .  '/core/templates/footer.php'; ?>