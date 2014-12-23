<?php

final class Cost
{
    private $pence;

    private function __construct() {}

    public static function fromString($string)
    {
        $cost = new Cost();
        $cost->pence = intval(floatval($string) * 100);

        return $cost;
    }

    public function add(\Cost $otherCost)
    {
        $cost = new Cost();
        $cost->pence = $this->pence + $otherCost->pence;

        return $cost;
    }

    public function addPercentage($percentage)
    {
        $cost = new Cost();
        $cost->pence = $this->pence + ($this->pence * $percentage)/100;

        return $cost;
    }

    public function isZero()
    {
        return $this->pence == 0;
    }

    public function isGreaterThan(\Cost $otherCost)
    {
        return $this->pence > $otherCost->pence;
    }

    public function __toString()
    {
        return sprintf('%.2f', $this->pence/100);
    }
}
