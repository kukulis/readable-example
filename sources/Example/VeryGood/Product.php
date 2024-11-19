<?php

namespace Example\VeryGood;

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

    /**
     * Instead of this better to use some DAO lib like JMSSerializer, or cuyz/valinor.
     */
    public function setData(array $data): Product
    {
        $this->sku = $data['sku'] ?? '';
        $this->quantity = $data['amount'] ?? 0;
        $this->price = $data['price'] ?? 0;

        return $this;
    }

    public function applyVat(float $vat): Product
    {
        $this->price = $this->price * (1 + $vat / 100);

        return $this;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}