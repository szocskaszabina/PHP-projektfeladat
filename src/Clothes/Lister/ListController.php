<?php
namespace Project\Clothes\Lister;


class ListController {


    private $lister;

    public function __construct(Lister $lister) {
        $this->lister = $lister;
    }

    public function getClothes(array $query):array {
        //ide jönne a business logic
        //...

       return $this->lister->getClothes($query);
    }
}