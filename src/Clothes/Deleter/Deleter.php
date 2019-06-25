<?php

namespace Project\Clothes\Deleter;

use Project\Clothes\Clothes;

interface Deleter
{
    public function deleteClothes(string $id): string;
}