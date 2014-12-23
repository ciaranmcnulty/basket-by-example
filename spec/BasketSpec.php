<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasketSpec extends ObjectBehavior
{
    function let(\DeliveryCostCalculator $calculator)
    {
        $this->beConstructedWith($calculator);
    }

    function it_costs_zero_when_no_products_have_been_added()
    {
        $this->getTotalCost()->shouldBeLike(\Cost::fromString('0.00'));
    }

    function it_adds_product_price_plus_vat_and_delivery_to_calculate_the_total_cost(\Catalogue $catalogue, \DeliveryCostCalculator $calculator)
    {
        $sku = \Sku::fromString('PR001');

        $catalogue->findProductWithSku($sku)->willReturn(
            \Product::withSkuAndCost($sku, \Cost::fromString('5.00'))
        );
        $calculator->calculateFromTotal(\Cost::fromString('5.00'))->willReturn(
            \Cost::fromString('3.00')
        );

        $this->addProductFromCatalogue($sku, $catalogue);

        $this->getTotalCost()->shouldBeLike(\Cost::fromString('9.00'));
    }
}
