<?php

class Basket
{
    /**
     * @var Cost
     */
    private $total;

    public function __construct()
    {
        $this->total = Cost::fromString('0.00');
    }

    public function addProductFromCatalogue(\Sku $sku, \Catalogue $catalogue)
    {
        $product = $catalogue->findProductWithSku($sku);
        $this->total = $this->total->add($product->getCost());
    }

    public function getTotalCost()
    {
        $cost = $this->total;

        if (!$cost->isZero()) {
            $cost = $cost->addPercentage(20);
            $cost = $cost->add(\Cost::fromString('3.00'));
        }

        return $cost;
    }
}
