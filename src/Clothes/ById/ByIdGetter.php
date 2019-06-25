<?php

namespace Project\Clothes\ById;

use Project\Clothes\Clothes;

interface ByIdGetter
{
    public function getItemById(string $id): Clothes;
}