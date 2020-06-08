<?php

function is_logged_in()
{
    if(!isset($_SESSION['username'])){
        return false;
    }
    
    $users = file_to_array('app/data/data.json');
    foreach($users['users'] as $user){
        if($_SESSION['password'] != $user['password']){
            return false;
        }
    }

    return true;
}
