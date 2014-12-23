<?php

final class Product
{
    private function __construct() {}

    public static function withSkuAndCost(Sku $sku, Cost $cost)
    {
        $product = new Product();

        return $product;
    }
}
