<?php

interface Catalogue
{
    public function findProductWithSku(Sku $sku);
    public function getAllProducts();
}