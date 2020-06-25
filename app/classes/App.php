<?php
namespace App;

class App
{
    //** @var \Core\FileDB */
    public static $db;

    //** @var \Core\Session */
    public static $session;

    public function __construct(string $file_name)
    {
        self::$db = new \Core\FileDB($file_name);
        self::$db->load();

        self::$session = new \Core\Session();
    }

    public function __destruct()
    {
        self::$db->save();
    }
}
