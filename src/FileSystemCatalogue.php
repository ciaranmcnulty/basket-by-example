<?php

use Everzet\PersistedObjects\AccessorObjectIdentifier;
use Everzet\PersistedObjects\FileRepository;

class FileSystemCatalogue implements Catalogue
{
    public function __construct()
    {
        $this->repo = new FileRepository(sys_get_temp_dir().'/catalogue', new AccessorObjectIdentifier('getSku'));
    }

    public function listProduct(Product $product)
    {
        $this->repo->save($product);
    }

    public function findProductWithSku(Sku $sku)
    {
        return $this->repo->findById($sku);
    }

    public function getAllProducts()
    {
        return $this->repo->getAll();
    }

    public function clear()
    {
        return $this->repo->clear();
    }
}