<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DeliveryCostCalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeliveryCostCalculator');
    }

    function it_calculates_cost_as_2_when_total_price_is_greater_than_ten()
    {
        $this->calculateFromTotal(\Cost::fromString('11.00'))->shouldBeLike(\Cost::fromString('2.00'));
    }

    function it_calculates_cost_as_3_when_total_price_is_less_than_ten()
    {
        $this->calculateFromTotal(\Cost::fromString('9.00'))->shouldBeLike(\Cost::fromString('3.00'));
    }

    function it_calculates_cost_as_3_when_total_price_is_exactly_ten()
    {
        $this->calculateFromTotal(\Cost::fromString('10.00'))->shouldBeLike(\Cost::fromString('3.00'));
    }
}
