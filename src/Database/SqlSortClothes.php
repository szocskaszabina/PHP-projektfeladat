<?php

namespace Project\Database;

use Project\Database\MySqlConnection;
use Project\Clothes\Clothes;
use Project\Clothes\Lister\Lister;

class SqlSortClothes implements Lister
{
    private $connection;

    public function __construct() {
        $this->connection = (new MySqlConnection())->connect();
    }

    function getClothes (array $query): array {
        $statement = "SELECT * FROM `clothes`";

        if(!empty($query['name'])) {
            
            $statement .= " WHERE `name` LIKE '%" . $query["name"] . "%' ";
            
        }
        if(!empty($query['size'])) {
            if(!empty($query['name'])){
            $statement .= " AND `size` = " . "'" . $query["size"] . "'" ;
            } else {
                $statement .= " WHERE `size` = " . "'" . $query["size"] . "'" ;
            }
        }
        if(!empty($query['min'])) {
            $str = (int)$query['min'];
            if(!empty($query['name']) || !empty($query['size'])){
            $statement .= ' AND `price` >= ' . $str;
            } else {
                $statement .= ' WHERE `price` >= ' . $str;
            }
        }
        if(!empty($query['max'])) {
            $str = (int)$query['max'];
            if(!empty($query['name']) || !empty($query['size']) || !empty($query['min'])) {
                $statement .= ' AND `price` <= ' . $str;
            } else {
            $statement .= ' WHERE `price` <= ' . $str;
            }
        }
        
        
        $result = $this->connection->query($statement);
        $items = [];
        while ($data = $result->fetch_assoc()) {
            $items[] = $data;
        }

        return array_map(function ($itemArray) {
            $clothes = new Clothes();
            $clothes->setId((string)$itemArray['id'])
            ->setName($itemArray['name'])
            ->setPrice((int)$itemArray['price'])
            ->setSize($itemArray['size'])
            ->setColor($itemArray['color'])
            ->setDiscount((float)$itemArray['discount'])
            ->setDiscountedPrice();

            return $clothes;
        }, $items);
    }
}

