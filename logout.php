<?php 
    require 'bootloader.php';
    session_destroy();
    header('Location: http://phpsualum:8888/FormTemplates/login.php');
?>