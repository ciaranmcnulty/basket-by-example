<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CostSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromString', ['10.00']);
    }

    function it_is_not_equal_to_different_value_costs()
    {
        $this->shouldNotBeLike(\Cost::fromString('9.00'));
    }

    function it_is_equal_to_same_value_costs()
    {
        $this->shouldBeLike(\Cost::fromString('10.00'));
    }

    function it_can_add_another_cost()
    {
        $this->add(\Cost::fromString('5.00'))->shouldBeLike(\Cost::fromString('15.00'));
    }

    function it_can_add_a_percentage()
    {
        $this->addPercentage(20)->shouldBeLike(\Cost::fromString('12.00'));
    }

    function it_knows_when_it_is_not_zero()
    {
        $this->isZero()->shouldReturn(false);
    }

    function it_knows_when_it_is_zero()
    {
        $this->beConstructedThrough('fromString', ['0.00']);
        $this->isZero()->shouldReturn(true);
    }

    function it_is_greater_than_costs_lower_than_itself()
    {
        $this->isGreaterThan(\Cost::fromString('9.00'))->shouldReturn(true);
    }

    function it_is_not_greater_than_costs_higher_than_itself()
    {
        $this->isGreaterThan(\Cost::fromString('11.00'))->shouldReturn(false);
    }

    function it_is_not_greater_than_itself()
    {
        $this->isGreaterThan(\Cost::fromString('10.00'))->shouldReturn(false);
    }

    function it_can_be_treated_as_a_string()
    {
        $this->__toString()->shouldReturn('10.00');
    }
}
