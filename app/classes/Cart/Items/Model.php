<?php

namespace App\Cart\Items;

use App\App;

class Model
{
    const TABLE = 'items';

    public static function insert(Item $item)
    {
        App::$db->createTable(self::TABLE);
        return App::$db->insertRow(self::TABLE, $item->_getData());
    }

    public static function getWhere(array $conditions)
    {
        $rows =  App::$db->getRowsWhere(self::TABLE, $conditions);
        $items = [];

        foreach ($rows as $row) {
            $item = new Item($row);
            $items[] = $item;
        }

        return $items;
    }

    public static function find($id)
    {
        $item_data = App::$db->getRowById(self::TABLE, $id);

        if ($item_data) {
            $item = new Item($item_data);
            $item->id  = $id;

            return $item;
        }

        return null;
    }

    public static function update(Item $item)
    {
        return App::$db->updateRow(self::TABLE, $item->_getData(), $item->id);
    }

    public static function delete(Item $item)
    {
        return App::$db->deleteRow(self::TABLE, $item->id);
    }

}
