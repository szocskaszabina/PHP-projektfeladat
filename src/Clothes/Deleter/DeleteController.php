<?php
namespace Project\Clothes\Deleter;


class deleteController {


    private $deleter;

    public function __construct(Deleter $deleter) {
        $this->deleter = $deleter;
    }

    public function deleteClothes(string $id):string {
        
       return $this->deleter->deleteClothes($id);
    }
}