<?php 

namespace App\Views\Forms;

class DrinkAddForm extends DrinkForm
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->data['buttons']['save']['title'] = 'Add';
    }
}