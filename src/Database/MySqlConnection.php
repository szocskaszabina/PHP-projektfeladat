<?php
namespace Project\Database;
use mysqli;
class MysqlConnection {
    public function connect() {
        $connection = new mysqli('localhost', 'root', 12345, 'clothes_project', 3306, );

        if ($connection->error !== '') {
            echo 'Adatbazis hiba';
            exit;
        }
        return $connection;
    }
}