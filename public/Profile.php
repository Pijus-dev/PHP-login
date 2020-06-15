<?php require '../bootloader.php'; ?>
<?php
$name = App::$db->getRowWhere('users', ['email' => $_SESSION['username']]);
$form = [
    'attrs' => [
        'method' => 'POST',
        'id' => 'my_id',
    ],
    'fields' => [
        'name' => [
            'label' => 'Name',
            'type' => 'text',
            'extra' => [
                'attrs' => [
                    'placeholder' => $name['name']
                ]
            ]
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'extra' => [
                'attrs' => [
                    'placeholder' => $name['email']
                ]
            ]
        ]
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

$form_values = sanitize_form_values($form);
if ($form_values) {
    $user = App::$db->getRowsWhere('users', ['email' => $_SESSION['username']]);

    App::$db->updateRow('users', [
        'name' => $form_values['name'], 
        'email' => $form_values['email'], 
        'password' => $_SESSION['password']
    ], key($user));

    $person = App::$db->getRowById('users', key($user));
    $_SESSION['username'] = $person['email'];
    print $_SESSION['username'];
}

?>



<?php require '../core/templates/head.php'; ?>
<?php require '../core/templates/navbar.php'; ?>
<div class="profile animate__animated animate__bounceInUp">
    <?php require '../core/templates/form.tpl.php'; ?>
</div>
<?php require '../core/templates/footer.php'; ?>