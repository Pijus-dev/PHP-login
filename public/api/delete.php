<?php
require '../../bootloader.php';

use App\Views\Forms\DeleteForm;
use App\Drinks\Drink;
use App\Drinks\Model;

function delete_success(&$form, $form_values)
{
    $item = new Drink($form_values);
   print json_encode(Model::delete($item));
}

$delete = new DeleteForm();
$delete->validate();
