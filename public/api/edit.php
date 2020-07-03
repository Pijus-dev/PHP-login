<?php
require '../../bootloader.php';

use App\Drinks\Drink;
use App\Drinks\Model;
use App\Views\Forms\Drinks\DrinkEditForm;

function form_success(&$form, $form_values)
{
    $drink = new Drink($form_values);
    Model::update($drink);
    print json_encode($drink);
}

function form_fail(&$form, $form_values)
{
    print 'neveikia';
}

$data = new DrinkEditForm();
$data->validate();
