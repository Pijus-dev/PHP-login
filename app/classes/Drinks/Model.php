<?php

namespace App\Drinks;

use App\App;

class Model
{
    const TABLE = 'products';

    public static function insert(Drink $drink)
    {
        App::$db->createTable(self::TABLE);
        return App::$db->insertRow(self::TABLE, $drink->_getData());
    }

    public static function getWhere(array $conditions)
    {
        $rows =  App::$db->getRowsWhere(self::TABLE, $conditions);
        $drinks = [];

        foreach ($rows as $row) {
            $drink = new Drink($row);
            $drinks[] = $drink;
        }

        return $drinks;
    }

    public static function find(int $id)
    {
        $drink_data = App::$db->getRowById(self::TABLE, $id);

        if ($drink_data) {
            $drink = new Drink($drink_data);
            $drink->id  = $id;

            return $drink;
        }

        return null;
    }

    public static function update(Drink $drink)
    {
        return App::$db->updateRow(self::TABLE, $drink->_getData(), $drink->id);
    }

    public static function delete(Drink $drink)
    {
        return App::$db->deleteRow(self::TABLE, $drink->id);
    }
}
