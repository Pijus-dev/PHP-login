<?php

namespace App\Pixels;

use App\App;

class Model
{
  const TABLE = 'pixels';

  public static function insert(Pixel $pixel)
  {
    return  App::$db->insertRow(self::TABLE, $pixel->_getData());
  }

  public static function getWhere(array $conditions)
  {
    $rows =  App::$db->getRowsWhere(self::TABLE, $conditions);
    $pixels = [];

    foreach ($rows as $row) {
      $pixel = new Pixel($row);
      $pixels[] = $pixel;
    }

    return $pixels;
  }

  public static function update(Pixel $pixel)
  {
    return App::$db->updateRow(self::TABLE, $pixel->_getData(), $pixel->id);
  }

  public static function delete(Pixel $pixel)
  {
    return App::$db->deleteRow(self::TABLE, $pixel->id);
  }
  
}
