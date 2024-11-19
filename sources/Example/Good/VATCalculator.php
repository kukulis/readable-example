<?php

namespace Example\Good;

class VATCalculator
{
    private float $vat;

    /**
     * @param float $vat
     */
    public function __construct(float $vat)
    {
        $this->vat = $vat;
    }

    /**
     * @param Product[] $products
     */
    public function applyVat(array $products) : void {
        foreach ($products as $product) {
            $product->setPrice( $product->price * (1+$this->vat/100) );
        }
    }
}