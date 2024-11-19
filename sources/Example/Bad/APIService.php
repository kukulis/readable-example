<?php

namespace Example\Bad;

use GuzzleHttp\Client;

class APIService
{
    private Repository $dbService;

    private Client $client;

    public function __construct(Repository $dbService, Client $client)
    {
        $this->dbService = $dbService;
        $this->client = $client;
    }

    public function getApiData(string $filter) : array
    {
        $response = $this->client->request('GET', 'api_endpoint/products', [
            'query' => ['filter'=>$filter]
        ]);

        $json = $response->getBody()->getContents();


        return json_decode($json, true);
    }


    /**
     * @return Product[]
     */
    public function getProducts(string $filter) : array {

        $data = $this->getApiData($filter);

        $skus = [];
        foreach ($data as $product) {
            $skus[] = $product['sku'];
        }
        $products = $this->dbService->getProducts($skus);

        /** @var Product[] $productsMap */
        $productsMap = [];
        foreach ($products as $product) {
            $productsMap[$product->sku] = $product;
        }

        foreach ($data as $apiProduct) {
            $productsMap[$apiProduct['sku']]->quantity = $apiProduct['amount'];
        }

        return $products;
    }
}