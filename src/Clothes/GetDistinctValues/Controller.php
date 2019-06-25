<?php
namespace Project\Clothes\GetDistinctValues;


class Controller {


    private $valuesGetter;

    public function __construct(ValuesGetter $valuesGetter) {
        $this->valuesGetter = $valuesGetter;
    }

    public function getValues(string $string): array {
        //ide jönne a business logic
        //...

       return $this->valuesGetter->getValues($string);
    }
}