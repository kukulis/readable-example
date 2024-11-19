<?php

namespace Example\Good;

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
    public function setData(array $data): Product {
        $this->sku = $data['sku'] ?? '';
        $this->quantity = $data['amount'] ?? 0;
        $this->price = $data['price'] ?? 0;

        return $this;
    }

    /**
     * @param Product[] $destinationProducts
     * @param Product[] $sourceProducts
     */
    public static function copyQuantities(array $destinationProducts, array $sourceProducts ) {
        $indexedBySku = [];
        foreach ($destinationProducts as $destinationProduct) {
            $indexedBySku[$destinationProduct->sku] = $destinationProduct;
        }

        foreach ($sourceProducts as $sourceProduct) {
            if ( !array_key_exists($sourceProduct->sku, $indexedBySku) ) {
                continue;
            }
            $indexedBySku[$sourceProduct->sku]->setQuantity($sourceProduct->quantity);
        }
    }
}