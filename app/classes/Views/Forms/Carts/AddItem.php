<?php

namespace App\Views\Forms\Carts;

use Core\Views\Form;

class AddItem extends Form
{
    public function __construct($data = [])
    {
        $add_item = [
            'attrs' => [
                'method' => 'POST',
            ],
            'fields' => [
                'id' => [
                    'type' => 'hidden',
                ],
            ],
            'buttons' => [
                'save' => [
                    'title' => 'Add To Cart',
                    'extra' => [
                        'attr' => [
                            'class' => 'add-item',
                        ]
                    ]
                ]
            ],
            'callbacks' => [
                'success' => 'add_success',
            ],
        ];

        parent::__construct($add_item);
    }
}
