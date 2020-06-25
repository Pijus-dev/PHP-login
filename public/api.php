<?php 
require_once '../bootloader.php';

$info= \App\Pixels\Model::getWhere([]);

$json_string = json_encode($info);

print $json_string;