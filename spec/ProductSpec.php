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

    function it_is_initializable()
    {
        $this->shouldHaveType('Product');
    }
}
