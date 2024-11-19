<?php

namespace Example\Bad;

use Psr\Http\Message\RequestInterface;

class Controller
{
    private CalculatorService  $calculator;

    public function __construct(CalculatorService $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @return Product[]
     */
    public function getProducts(RequestInterface $request) : array {
        $params = $request->getBody();
        return $this->calculator->getProducts($params);
    }
}