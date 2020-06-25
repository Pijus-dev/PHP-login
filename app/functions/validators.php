<?php 

/** 
* match_coordinate_validator checks in the database if the given coordinates already exist or not
*
* @param  array $form_values
* @param  array $form
* @return bool
*/
function coordinate_validator(array $form_values, array &$form): bool
{
    $pixel = new \App\Pixels\Pixel($form_values);
    $pixel = App\App::$db->getRowWhere('wall', ['x' => $pixel->x, 'y' => $pixel->y]);

   if ($pixel && $pixel['email'] != $_SESSION['username']) {
       $form['error_message'] = 'Coordinates have been already taken';
       return false;
   }

   return true;
}