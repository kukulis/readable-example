<?php

namespace Example\Bad;

use PDO;

class Repository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return Product[]
     */
    public function getProducts($skus) : array{
        $quotedSkus = [];
        foreach($skus as $sku){
            $quotedSkus[] = $this->pdo->quote($sku);
        }
        $skusStr = implode(',', $quotedSkus);
        $sql = "SELECT * FROM products where id in ($skusStr)";

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, Product::class);
    }
}