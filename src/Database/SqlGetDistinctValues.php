<?php

namespace Project\Database;

use Project\Database\MySqlConnection;
use Project\Clothes\GetDistinctValues\ValuesGetter;
use \Exception;

class SqlGetDistinctValues implements ValuesGetter {
    private $connection;

    public function __construct() {
        $this->connection = (new MySqlConnection())->connect();
    }

    public function getValues (string $string): array {
        $query = 'SELECT DISTINCT ' . $string . ' from `clothes`';
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result = $statement->get_result();
        $items = [];
        while ($data = $result->fetch_assoc()) {
            $items[] = $data;
        };
        $values = [];
            foreach ($items as $key => $value) {
                $values[] = $value[$string];
            };

        return $values;


    }
}