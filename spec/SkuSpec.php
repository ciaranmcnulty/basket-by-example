<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SkuSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('fromString', ['PR001']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sku');
    }

    function it_can_be_treated_as_a_string()
    {
        $this->__toString()->shouldReturn('PR001');
    }
}
