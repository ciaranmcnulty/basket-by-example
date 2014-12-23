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

    private $basket;

    public function __construct()
    {
        $this->basket = new Basket();
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
        $this->basket->addProductFromCatalogue($sku, $this->catalogue);
    }

    /**
     * @Then the total cost of my basket should be £:cost
     */
    public function theTotalPriceOfMyBasketShouldBePs(Cost $cost)
    {
        PHPUnit_Framework_Assert::assertEquals($cost, $this->basket->getTotalCost());
    }
}
