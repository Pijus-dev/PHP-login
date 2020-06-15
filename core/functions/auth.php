<?php

/**
 * is_logged_in checks if the user is logged in
 * @return bool
 */
function is_logged_in()
{
    if (isset($_SESSION['username'])) {
        $db = new FileDB(DB_FILE);
        $db->load();
        $user = $db->getRowWhere('users', [
            'email' => $_SESSION['username'], 
            'password' => $_SESSION['password']
        ]);
      
         return $user ? true : false;
    }
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
