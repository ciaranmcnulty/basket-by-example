<?php

use Everzet\PersistedObjects\AccessorObjectIdentifier;
use Everzet\PersistedObjects\InMemoryRepository;

class InMemoryCatalogue implements Catalogue
{
    public function __construct()
    {
        $this->repo = new InMemoryRepository(new AccessorObjectIdentifier('getSku'));
    }

    public function listProduct(Product $product)
    {
        $this->repo->save($product);
    }

    public function findProductWithSku(Sku $sku)
    {
        return $this->repo->findById($sku);
    }
}