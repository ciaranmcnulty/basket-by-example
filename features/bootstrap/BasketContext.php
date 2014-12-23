<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class BasketContext implements Context, SnippetAcceptingContext
{
    private $catalogue;

    public function __construct()
    {
        $this->catalogue = new InMemoryCatalogue();

    }

    /**
     * @Transform :sku
     */
    public function transformStringToSku($sku)
    {
        return Sku::fromString($sku);
    }

    /**
     * @Transform :cost
     */
    public function transformStringToCost($cost)
    {
        return Cost::fromString($cost);
    }

    /**
     * @Given a product with SKU :sku and a cost of £:cost has been listed in the catalogue
     */
    public function thereIsAProductWithSkuAndACostOfPsInTheCatalogue(Sku $sku, Cost $cost)
    {
        $aProduct = Product::withSkuAndCost($sku, $cost);
        $this->catalogue->listProduct($aProduct);
    }

    /**
     * @When I add the product with SKU :sku from the catalogue to my basket
     */
    public function iAddTheProductWithSkuFromTheCatalogueToMyBasket(Sku $sku)
    {
        $aBasket = new Basket();
        $aBasket->addProductFromCatalogue($sku, $this->catalogue);
    }

    /**
     * @Then the total price of my basket should be £:arg1
     */
    public function theTotalPriceOfMyBasketShouldBePs($arg1)
    {
        throw new PendingException();
    }
}
