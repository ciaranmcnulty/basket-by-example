<?php

namespace spec;

use Cost;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sku;

class ProductSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('withSkuAndCost', [Sku::fromString('PR001'), Cost::fromString('10.00')]);
    }

    function it_returns_its_cost()
    {
        $this->getCost()->shouldBeLike(Cost::fromString('10.00'));
    }

    function it_returns_its_sku()
    {
        $this->getSku()->shouldBeLike(Sku::fromString('PR001'));
    }
}
