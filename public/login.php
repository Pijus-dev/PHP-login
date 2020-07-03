<?php
require '../bootloader.php';

use App\App;
use App\Views\Navigation;
use App\User\Model;
use App\Views\Forms\Auth\Login;
/**
 * form_success shows an success message if everything went well
 *
 * @param  mixed $form
 * @param  mixed $form_values
 * @return void
 */
function form_success(&$data, $form_values)
{
    $user_data = Model::getWhere(['email' => $form_values['email']]);

    $user = $user_data[0];
    App::$session->login($user->email, $user->password);


    header('Location:/products.php');
}

/**
 * form_fail shows an error message if form returns false
 *
 * @param  array $form
 * @param  array $form_values
 * @return mixed
 */
function form_fail(&$data, $form_values)
{
    $data['error_message'] = 'Failed to login';
}

$view = new Login();
$navigation = new Navigation();
$view->validate();


$form_template = $view->render();

require_once  ROOT .  '/core/templates/head.php';
print $navigation->render();

?>

<main>
    <div class="test animate__animated animate__bounceInDown">
        <?php print $form_template; ?>
    </div>
</main>

<?php require  ROOT .  '/core/templates/footer.php'; ?>