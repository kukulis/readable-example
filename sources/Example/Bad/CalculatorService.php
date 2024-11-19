<?php

namespace Example\Bad;

class CalculatorService
{
    private float $vatPercent;
    private APIService  $apiService;

    public function __construct(float $vatPercent, APIService $apiService)
    {
        $this->vatPercent = $vatPercent;
        $this->apiService = $apiService;
    }


    /**
     * @return Product[]
     */
    public function getProducts(string $requestData) : array {
        $products = $this->apiService->getProducts($requestData);

        foreach ($products as $product) {
            $product->price = $product->price * ( 1 + $this->vatPercent);
        }

        return $products;
    }
}