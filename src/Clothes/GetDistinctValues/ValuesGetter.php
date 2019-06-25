<?php

namespace Project\Clothes\GetDistinctValues;



interface ValuesGetter {
    
    public function getValues (string $string): array;
}