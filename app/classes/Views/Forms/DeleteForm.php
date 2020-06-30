<?php 

namespace App\Views\Forms;

use Core\Views\Form;

class DeleteForm extends Form
{
    public function __construct($data = [])
    {
        $delete_form = [
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
                    'title' => '&#10006;',
                    'extra' => [
                        'attr' => [
                            'class' => 'small-btn'
                        ]
                    ]
                ]
            ],
            'callbacks' => [
                'success' => 'delete_success',
            ],
        ];

        parent::__construct($delete_form);
    }
}