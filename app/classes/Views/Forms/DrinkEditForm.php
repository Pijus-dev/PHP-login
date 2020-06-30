<?php 

namespace App\Views\Forms;

class DrinkEditForm extends DrinkForm
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->data['buttons']['save']['title'] = 'Edit';
    }
}