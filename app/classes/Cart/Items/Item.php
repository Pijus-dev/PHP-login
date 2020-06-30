<?php

namespace App\Cart\Items;

use App\Drinks\Drink;
use App\User\User;
use Core\DataHolder;
use App\User\Model;


class Item  extends DataHolder
{
    protected function setId(int $id)
    {
        $this->id = $id;
    }

    protected function getId()
    {
        return $this->id ?? null;
    }

    protected function setDrinkId(int $drink_id)
    {
        $this->drink_id = $drink_id;
    }

    protected function getDrinkId()
    {
        return $this->drink_id ?? null;
    }

    protected function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    protected function getUserId()
    {
        return $this->user_id ?? null;
    }

    public function user(): User
    {
        $user = Model::find($this->getUserId());
        if ($user) {
            return $user;
        }
    }

    public function drink(): Drink
    {
        $drink = \App\Drinks\Model::find($this->getDrinkId());
        if ($drink) {
            return $drink;
        }
    }
}
