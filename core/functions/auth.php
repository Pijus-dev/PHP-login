<?php

/**
 * is_logged_in checks if the user is logged in
 * @return bool
 */
function is_logged_in(): bool
{
    if (isset($_SESSION['username'])) {
        $users = file_to_array(DB_FILE);

        foreach ($users['users'] as $user) {
            if ($_SESSION['password'] === $user['password'] && $_SESSION['username'] === $user['password']) {
                return true;
            }
        }
    }

    return false;
}

/**
 * logout
 *
 * @param  bool $redirect
 * @return void
 */
function logout($redirect = false)
{
    $_SESSION = [];
    setcookie(session_name(), '', time() - 3600, '/');
    session_destroy();

    if ($redirect) {
        header('Location:/login.php');
    }
}
