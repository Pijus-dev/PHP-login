<?php

namespace App\Views\Forms;

use Core\Views\Form;

class DrinkForm extends Form
{
    public function __construct($data = [])
    {
        $form = [
            'attrs' => [
                'method' => 'POST',
                'id' => 'add',
            ],
            'fields' => [
                'name' =>  [
                    'label' => 'Name',
                    'type' => 'text',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_field_empty_space',
                    ],
                ],
                'percentage' => [
                    'label' => 'Percentage %',
                    'type' => 'text',
                    'validators' => [
                        'validate_field_is_numeric',
                        'validate_field_not_empty',
                        'validate_field_empty_space',
                    ],
                ],
                'size' => [
                    'label' => 'Size (ml)',
                    'type' => 'text',
                    'validators' => [
                        'validate_field_is_numeric',
                        'validate_field_not_empty',
                        'validate_field_empty_space',
                    ],
                ],
                'amount' => [
                    'label' => 'Available in stock',
                    'type' => 'text',

                    'validators' => [
                        'validate_field_is_numeric',
                        'validate_field_not_empty',
                        'validate_field_empty_space',
                    ],

                ],
                'price' => [
                    'label' => 'Price (EUR)',
                    'type' => 'text',

                    'validators' => [
                        'validate_field_is_numeric',
                        'validate_field_not_empty',
                        'validate_field_empty_space',
                    ],
                ],
                'photo' => [
                    'label' => 'Photo',
                    'type' => 'text',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_field_empty_space',
                    ]
                ]
            ],
            'buttons' => [
                'save' => [
                    'title' => 'Submit',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn'
                        ]
                    ]
                ]
            ],
            'callbacks' => [
                'success' => 'form_success',
                'fail' => 'form_fail'
            ],
        ];

        parent::__construct($form);
    }
}
