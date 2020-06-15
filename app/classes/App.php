<?php

class App
{
    //** @var \Core\FileDB */
    public static $db;

    public function __construct(string $file_name)
    {
        self::$db = new FileDB($file_name);
        self::$db->load();
    }

    public function __destruct()
    {
        self::$db->save();
    }
}
