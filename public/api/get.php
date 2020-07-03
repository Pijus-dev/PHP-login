<?php
require '../../bootloader.php';

use App\Drinks\Model;

$drinks = Model::getWhere([]);
print json_encode($drinks);
