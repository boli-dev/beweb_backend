<?php

namespace Database;
use \PDO;

class Database {

    private $db_name;
    private $db_host;
    private $db_user;
    private $db_password;
    private $pdo;

    /**
     * Database constructor.
     * @param $db_name
     * @param $db_host
     * @param $db_user
     * @param $db_password
     */
    public function __construct($db_name, $db_host, $db_user = "root", $db_password = "") {
        $this->db_name = $db_name;
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
    }

    private function getPDO() {
        if($this->pdo === null) {
            $pdo = new PDO('mysql:dbname=project;host=localhost', 'root' ,$this->db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query($sql, $class) {
        $stm = $this->getPDO()->query($sql);
        return $stm->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function prepare($sql, $attr, $class) {
        $stm = $this->getPDO()->prepare($sql);
        $stm->execute($attr);
        $stm->setFetchMode(PDO::FETCH_CLASS, $class);
        return $stm->fetch();
    }
    public function updateQuery($sql, $attr) {
        return $this->getPDO()->prepare($sql)->execute($attr);
    }



}