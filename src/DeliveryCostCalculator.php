<?php

class DeliveryCostCalculator
{

    public function calculateFromTotal(\Cost $cost)
    {
        if ($cost->isGreaterThan(\Cost::fromString('10.00'))) {
            return \Cost::fromString('2.00');
        }

        return \Cost::fromString('3.00');
    }
}
