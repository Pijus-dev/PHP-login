<?php

namespace App\Views\Forms\Drinks;

class DrinkEditForm extends DrinkForm
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->data['buttons']['save']['title'] = 'Edit';
        $this->data['fields']['id']['type'] = 'hidden';
    }
}
