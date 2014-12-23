<?php

class Basket
{
    /**
     * @var Cost
     */
    private $total;
    /**
     * @var DeliveryCostCalculator
     */
    private $calculator;

    public function __construct(DeliveryCostCalculator $calculator)
    {
        $this->total = Cost::fromString('0.00');
        $this->calculator = $calculator;
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
            $cost = $cost->add($this->calculator->calculateFromTotal($this->total));
        }

        return $cost;
    }
}
