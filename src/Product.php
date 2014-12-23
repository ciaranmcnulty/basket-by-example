<?php

final class Product
{
    /**
     * @var Cost
     */
    private $cost;

    /**
     * @var Sku
     */

    private function __construct() {}

    public static function withSkuAndCost(Sku $sku, Cost $cost)
    {
        $product = new Product();
        $product->cost = $cost;
        $product->sku = $sku;

        return $product;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getSku()
    {
        return $this->sku;
    }
}
