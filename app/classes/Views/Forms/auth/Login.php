<?php 
namespace App\Views\Forms\Auth;

use Core\Views\Form;

class Login extends Form
{
    public function __construct($data = [])
    {
        $data = [
            'attrs' => [
                'method' => 'POST',
                'id' => 'my_id',
                'class' => 'my_class'
            ],
            'fields' => [
                'email' => [
                    'label' => 'Email',
                    'type' => 'email',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_field_empty_space',
                    ],
                ],
                'password' => [
                    'label' => 'Password',
                    'type' => 'password',
                    'validators' => [
                        'validate_field_not_empty',
                        'validate_field_empty_space',
                        'validate_field_password',
                    ]
                ],
            ],
            'validators' => [
                'validate_fields_match' => [
                    'password',
                ],
                'validate_login'
            ],
            'callbacks' => [
                'success' => 'form_success',
                'fail' => 'form_fail',
            ],
            'buttons' => [
                'save' => [
                    'title' => 'submit',
                    'extra' => [
                        'attr' => [
                            'class' => 'btn'
                        ]
                    ]
                ]
            ]
        ];

        parent::__construct($data);
    }
}