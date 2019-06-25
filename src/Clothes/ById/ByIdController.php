<?php

namespace Project\Clothes\ById;

use Project\Clothes\Clothes;

class ByIdController
{
    private $byIdGetter;

    public function __construct(ByIdGetter $byIdGetter) {
        $this->byIdGetter = $byIdGetter;
    }

    public function getById(string $id): Clothes {
        
            return $this->byIdGetter->getItemById($id);
        

    }

}