<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasketSpec extends ObjectBehavior
{
    function it_costs_zero_when_no_products_have_been_added()
    {
        $this->getTotalCost()->shouldBeLike(\Cost::fromString('0.00'));
    }

    function it_costs_the_total_plus_vat_and_delivery(\Catalogue $catalogue)
    {
        $sku = \Sku::fromString('PR001');

        $catalogue->findProductWithSku($sku)->willReturn(
            \Product::withSkuAndCost($sku, \Cost::fromString('5.00'))
        );

        $this->addProductFromCatalogue($sku, $catalogue);

        $this->getTotalCost()->shouldBeLike(\Cost::fromString('9.00'));
    }
}
