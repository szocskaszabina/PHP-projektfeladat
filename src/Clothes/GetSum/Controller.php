<?php
namespace Project\Clothes\GetSum;


class Controller {


    private $sumGetter;

    public function __construct(SumGetter $sumGetter) {
        $this->sumGetter = $sumGetter;
    }

    public function getSum(): array {
        //ide jönne a business logic
        //...

       return $this->sumGetter->getSum();
    }
}