<?php

namespace Example\Bad;

class Product
{
    public string $sku = '';
    public int $quantity = 0;
    public float $price = 0;

    public function setSku(string $sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    public function setQuantity(int $quantity): Product
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function setPrice(float $price): Product
    {
        $this->price = $price;
        return $this;
    }


}