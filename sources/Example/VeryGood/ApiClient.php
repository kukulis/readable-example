<?php

namespace Example\VeryGood;

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
    public function getProducts(string $filter): array {
        $response = $this->client->request('GET', 'api_endpoint/products', [
            'query' => ['filter'=>$filter]
        ]);

        $json = $response->getBody()->getContents();
        $data = json_decode($json, true);

        return array_map( fn($element)=> (new Product())->setData($element), $data);
    }
}