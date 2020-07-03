<?php
require_once '../bootloader.php';

use App\User\User;
use App\Views\Navigation;
use App\User\Model;
use App\Views\Forms\Auth\Register;


/**
 * form_success shows an success message if everything went well
 *
 * @param  mixed $form
 * @param  mixed $form_values
 * @return void
 */
function form_success(&$data, $form_values)
{
    $form_values['password'] = password_hash($form_values['password'], PASSWORD_BCRYPT);

    $user = new User($form_values);
    $user->role = User::ROLE_USER;

    Model::insert($user);

    $form['success_message'] = 'Successfully registered';
}

/**
 * form_fail shows an error message if form returns false
 *
 * @param  array $form
 * @param  array $form_values
 * @return mixed
 */
function form_fail(&$form, $form_values)
{
    $form['error_message'] = 'Something went wrong';
}


$view = new Register();
$navigation = new Navigation();
$view->validate();

$form_template = $view->render();

require ROOT . '/core/templates/head.php';
print $navigation->render();

?>

<main>
    <div class="test animate__animated animate__bounceInDown">
        <?php print $form_template; ?>
    </div>
</main>

<?php require ROOT . '/core/templates/footer.php'; ?>