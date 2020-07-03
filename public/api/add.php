<?php
require '../../bootloader.php';

use App\Drinks\Drink;
use App\Drinks\Model;
use App\Views\Forms\Drinks\DrinkAddForm;

function form_success(&$form, $form_values)
{
    $drink = new Drink($form_values);
    $id =  Model::insert($drink);
    $drink->id = $id;
    print json_encode($drink);
}

$add = new DrinkAddForm();
$add->validate();
