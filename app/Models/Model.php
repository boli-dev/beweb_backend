<?php


namespace App\Models;

use App\App;
use Database\Database;

class Model {

    protected static $table;

    public static function all() {
        return App::getDB()->query("SELECT * FROM ". static::$table ." ", get_called_class());
    }

    public static function find($id) {
        return App::getDB()->prepare("select * from ". static::$table ." where id = ?", [$id], get_called_class());
    }

    public static function findByUsernameAndPassword($username, $password) {
        return App::getDB()->prepare("select * from ". static::$table ." where username = ? and password = ?", [$username, $password], get_called_class());
    }

    public static function insertOrUpdate($attr, $a) {
        if($a) {
            return App::getDB()->updateQuery("INSERT INTO ". static::$table ." (name, username, email, password, created_at) VALUES (:name, :username, :email, :password, :created_at)", $attr);
        } else {
            return App::getDB()->updateQuery("UPDATE ". static::$table ." SET name = :name, username = :username, email = :email, password = :password, created_at = :created_at WHERE id= :id", $attr);
        }
    }

    public static function delete($attr) {
        return App::getDB()->updateQuery("DELETE FROM ". static::$table ." WHERE id= :id", $attr);
    }

}