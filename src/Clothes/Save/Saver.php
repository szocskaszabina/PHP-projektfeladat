<?php

namespace Project\Clothes\Save;

use Project\Clothes\Clothes;

interface Saver
{
    public function save(Clothes $item): Clothes;
}