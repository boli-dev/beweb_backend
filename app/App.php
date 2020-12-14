<?php

namespace App;

use Database\Database;

class App {

    private static $database;

    public static function getDB() {
        if(self::$database == null) {
            self::$database = new Database('project', 'localhost');
        }
        return self::$database;
    }

}