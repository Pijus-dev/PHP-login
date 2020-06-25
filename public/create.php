<?php

require_once '../bootloader.php';

// if (!App\App::$session->getUser()){
//    print json_encode('neprisijunges');
//    exit();
// }

$data = [
    'fields' => [
        'x' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
                'validate_field_is_numeric',
                'validate_field_range' => [
                    'min' => 0,
                    'max' => 500
                ],
                'validate_field_is_numeric'
            ],
        ],
        'y' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
                'validate_field_is_numeric',
                'validate_field_range' => [
                    'min' => 0,
                    'max' => 500
                ],
                'validate_field_is_numeric'
            ],
        ],
        'color' => [
            'validators' => [
                'validate_field_not_empty',
                'validate_field_empty_space',
            ],
            'type' => 'select',
            'value' => 'green',
            'options' => [
                'red' => 'Red',
                'green' => 'Green',
                'brown' => 'Brown',
                '#FFD700' => 'Yellow',
            ]
        ],
    ],
    'callbacks' => [
        'success' => 'form_success',
    ],
    'validators' => [
        'coordinate_validator'
    ]
];

$form_values = sanitize_form_values($data);

if ($form_values) {
    validate_form($data, $form_values);
} else {
    print 'Neko nebuvo poste';
}

function form_success($data, $form_values)
{
   $pixel =  new App\Pixels\Pixel($form_values);
   $id = App\Pixels\Model::insert($pixel);

   print json_encode($id);
}
