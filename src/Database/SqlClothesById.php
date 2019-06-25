<?php

namespace Project\Database;

use Project\Database\MySqlConnection;
use Project\Clothes\Clothes;
use Project\Clothes\ById\ByIdGetter;
use \Exception;

class SqlClothesById implements ByIdGetter
{
    private $connection;

    public function __construct() {
        $this->connection = (new MySqlConnection())->connect();
    }

    function getItemById(string $id): Clothes
    {
        $statement = $this->connection->prepare(
            "SELECT * FROM `clothes` WHERE `id`= ?"
        );

        $statement->bind_param('s', $id);
        $statement->execute();

        $result = $statement->get_result()->fetch_assoc();

        return (new Clothes())
            ->setId((string)$result['id'])
            ->setName((string)$result['name'])
            ->setPrice((int)$result['price'])
            ->setSize((string)$result['size'])
            ->setColor((string)$result['color'])
            ->setDiscount((float)$result['discount'])
            ->setDiscountedPrice()
            ;

    }
}

