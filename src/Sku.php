<?php

final class Sku
{
    private $string;

    private function __construct() {}

    public static function fromString($string)
    {
        $sku = new Sku();
        $sku->string = $string;

        return $sku;
    }

    public function __toString()
    {
        return $this->string;
    }
}
