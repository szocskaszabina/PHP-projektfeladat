<?php
namespace Project\Clothes\Update;

use Project\Clothes\Clothes;

interface Updater {
    public function updateClothes(Clothes $item): Clothes;
}