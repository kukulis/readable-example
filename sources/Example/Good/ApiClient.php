<?php

namespace Example\Good;

use GuzzleHttp\Client;

class ApiClient
{

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Product[]
     */
    public function getProducts(string $filter): array
    {
        $response = $this->client->request('GET', 'api_endpoint/products', [
            'query' => ['filter' => $filter]
        ]);

        $json = $response->getBody()->getContents();


        $data = json_decode($json, true);

        $products = [];
        foreach ($data as $productArray) {
            $products[] = (new Product())->setData($productArray);
        }

        return $products;
    }
}