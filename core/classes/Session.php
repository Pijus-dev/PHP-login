<?php

namespace Core;

use App\App;
use App\User\User;
use App\User\Model;

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
        return $this->login($_SESSION['username'] ?? '', $_SESSION['password'] ?? '');
    }

    public function login(string $email, string $password): bool
    {
        $user_data = Model::getWhere(['email' => $email, 'password' => $password]);

        if ($user_data) {
            $user = $user_data[0];
            $_SESSION['username'] = $user->email;
            $_SESSION['password'] = $user->password;

            $this->user = $user;

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
