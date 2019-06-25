<?php

namespace Project\Database;

use Project\Database\MySqlConnection;
use Project\Clothes\Clothes;
use Project\Clothes\Update\Updater;
use \Exception;

class SqlUpdateClothes implements Updater {
    private $connection;

    public function __construct() {
        $this->connection = (new MySqlConnection())->connect();
    }

    public function updateClothes (Clothes $item): Clothes {

        $statement = $this->connection->prepare(
            "UPDATE `clothes` SET 
            `name` = ?, 
            `price` = ?,
            `size` = ?,
            `color` = ?,
            `discount` = ?,
            `discountedPrice` = ?
            WHERE `clothes`.`id` = ?;"
        );
        $id = $item->getId();
        $name = $item->getName();
        $price = $item->getPrice();
        $size = $item->getSize();
        $color = $item->getColor();
        $discount = $item->getDiscount();
        $discountedPrice = $item->getDiscountedPrice();

        $statement->bind_param(
            "sissdis",
             $name, $price, $size, $color, $discount, $discountedPrice, $id
         );
        $statement->execute();

        if(!$statement->execute()) {
            echo 'adatbazis hiba';
            exit;
        }

        return $item;


    }
}