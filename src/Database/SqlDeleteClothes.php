<?php

namespace Project\Database;

use Project\Database\MySqlConnection;
use Project\Clothes\Clothes;
use Project\Clothes\Deleter\Deleter;
use \Exception;

class SqlDeleteClothes implements Deleter {
    private $connection;

    public function __construct() {
        $this->connection = (new MySqlConnection())->connect();
    }

    public function deleteClothes (string $id): string {

        $statement = $this->connection->prepare('DELETE FROM `clothes` WHERE `id` = ?');

        $statement->bind_param('s', $id);
        $statement->execute();

        if ($statement->affected_rows === 0) {
            throw new Exception('Sikertelen művelet!');
        }

        return $id;


    }
}