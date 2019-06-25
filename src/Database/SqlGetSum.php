<?php

namespace Project\Database;

use Project\Database\MySqlConnection;
use Project\Clothes\GetSum\SumGetter;
use \Exception;

class SqlGetSum implements SumGetter {
    private $connection;

    public function __construct() {
        $this->connection = (new MySqlConnection())->connect();
    }

    public function getSum (): array {

        $statement = $this->connection->prepare('SELECT SUM(discountedPrice) from `clothes`');

        $statement->execute();
        $result = $statement->get_result()->fetch_row();


        return $result;


    }
}