<?php

namespace App\User;

use Core\DataHolder;

class User extends DataHolder
{
    const  ROLE_ADMIN = 1;
    const  ROLE_USER  = 0;

    protected function setUsername(string $value)
    {
        $this->username = $value;
    }

    protected function getUsername()
    {
        return  $this->username ?? null;
    }

    protected function setEmail(string $email)
    {
        $this->email = $email;
    }

    protected function getEmail()
    {
        return $this->email ?? null;
    }

    protected function setName($name)
    {
        $this->name = $name;
    }

    protected function getName()
    {
        return $this->name ?? null;
    }

    protected function setPassword(string $password)
    {
        $this->password = $password;
    }

    protected function getPassword()
    {
        return  $this->password ?? null;
    }

    protected function setRole(int $role)
    {
        $this->role = $role;
    }

    protected function getRole()
    {
       return  $this->role ?? null;
    }

    protected function setId(int $id)
    {
        $this->id = $id;
    }

    protected function getId()
    {
        return $this->id ?? null;
    }
    
}
