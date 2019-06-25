<?php

namespace Project\Clothes;

class Clothes {
    private $id;
    private $name;
    private $price;
    private $size;
    private $color;
    private $discount; 
    private $discountedPrice;

    public function setId(string $id): Clothes
    {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name): Clothes
    {
        $this->name = $name;
        return $this;
    }

    public function setPrice(int $price): Clothes
    {
        $this->price = $price;
        return $this;
    }

    public function setSize(string $size): Clothes
    {
        $this->size = $size;
        return $this;
    }

    public function setColor(string $color): Clothes
    {
        $this->color = $color;
        return $this;
    }

    public function setDiscount(float $discount): Clothes
    {
        $this->discount = $discount;
        return $this;
    }
    public function setDiscountedPrice(): Clothes {
        if ($this->discount > 0) {
            $this->discountedPrice = $this->price * (1- $this->discount);
            return $this;
        }
        else $this->discountedPrice = $this->price;
        return $this;
    }
    public function getDiscountedPrice(): int
    {
        return $this->discountedPrice;
        
    }

    public function getId(): string
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

}