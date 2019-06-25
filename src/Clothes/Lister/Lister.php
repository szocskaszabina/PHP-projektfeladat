<?php

namespace Project\Clothes\Lister;



interface Lister {
    //return Clothes []
    public function getClothes (array $query): array;
}