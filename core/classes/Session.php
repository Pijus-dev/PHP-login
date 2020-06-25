<?php

namespace Core;

use App\App;

class Session
{

    /**
     *  initial empty array  with user data
     * @var mixed
     */
    private $user = [];

    public function __construct()
    {
        session_start();
        $this->loginFromCookie();
    }

    public function loginFromCookie()
    {
        // var_dump($_SESSION['username']);
        // var_dump($_SESSION['password']);
        return $this->login($_SESSION['username'] ?? '', $_SESSION['password'] ?? '');
    }

    public function login(string $email, string $password): bool
    {
        $user_data = App::$db->getRowWhere('users', ['email' => $email, 'password' => $password]);


        if ($user_data) {

            $_SESSION['username'] = $email;
            $_SESSION['password'] = $password;
            $this->user = $user_data;

            return true;
        }

        return false;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function update_session($email)
    {
       return $_SESSION['username'] = $email;
    }

    public function logout(string $redirect = null)
    {
        $_SESSION = [];
        setcookie(session_name(), '', time() - 3600, '/');
        session_destroy();

        $this->user = [];

        if ($redirect) {
            header("Location: $redirect");
        }
    }
}
