<?php

namespace Example\Good;

use Psr\Http\Message\RequestInterface;

class Controller
{
    private ApiClient $apiClient;
    private Repository $repository;
    private VATCalculator $vatCalculator;

    public function __construct(ApiClient $apiClient, Repository $repository, VATCalculator $vatCalculator)
    {
        $this->apiClient = $apiClient;
        $this->repository = $repository;
        $this->vatCalculator = $vatCalculator;
    }


    /**
     * @return Product[]
     */
    public function getProducts(RequestInterface $request) : array {
        $params = $request->getBody();

        $products = $this->apiClient->getProducts($params);

        $skus = [];
        foreach ($products as $product) {
            $skus[] = $product->sku;
        }

        $dbProducts = $this->repository->getProducts($skus);

        Product::copyQuantities($dbProducts, $products);

        $this->vatCalculator->applyVat($dbProducts);

        return $dbProducts;
    }

}