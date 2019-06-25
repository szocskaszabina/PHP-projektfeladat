<?php

namespace Project\Database;

use Project\Database\MySqlConnection;
use Project\Clothes\Clothes;
use Project\Clothes\Save\Saver;
use \Exception;

class SqlSaveClothes implements Saver
{
    private $connection;

    public function __construct() {
        $this->connection = (new MySqlConnection())->connect();
    }

    function save(Clothes $item): Clothes
    {
        $statement = $this->connection->prepare(
            "INSERT INTO `clothes` (
            `id`, `name`, `price`, `size`, `color`, `discount`, `discountedPrice`
            ) 
            VALUES (NULL, ?,?,?,?,?,?);"
        );

        $name = $item->getName();
        $price = $item->getPrice();
        $size = $item->getSize();
        $color = $item->getColor();
        $discount = $item->getDiscount();
        $discountedPrice = $item->getDiscountedPrice();

        $statement->bind_param(
            "sissdi",
             $name, $price, $size, $color, $discount, $discountedPrice
         );
        $statement->execute();

        if($statement->affected_rows !== 1) {
            throw new Exception();
        }
        return (new Clothes())
            ->setId((string)$statement->insert_id)
            ->setName($item->getName())
            ->setPrice($item->getPrice())
            ->setSize($item->getSize())
            ->setColor($item->getColor())
            ->setDiscount($item->getDiscount())
            ->setDiscountedPrice();
            ;
    }
}

