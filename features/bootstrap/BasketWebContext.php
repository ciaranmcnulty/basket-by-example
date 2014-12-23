<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class BasketWebContext extends RawMinkContext implements Context, SnippetAcceptingContext
{
    private $catalogue;

    private $basket;

    public function __construct()
    {
        $this->basket = new Basket(new DeliveryCostCalculator());
        $this->catalogue = new FileSystemCatalogue();
        $this->catalogue->clear();

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
    public function iAddTheProductWithSkuFromTheCatalogueToMyBasket($sku)
    {
        $this->visitPath('/catalogue.php');
        $this->assertSession()->elementExists('css', ".product:contains($sku)");

        $this->getSession()->getPage()->find('css', ".product:contains($sku)")
            ->clickLink('Add to Basket');
    }

    /**
     * @Then the total cost of my basket should be £:cost
     */
    public function theTotalCostOfMyBasketShouldBePs($cost)
    {
        $this->assertSession()->pageTextContains("Total cost: £$cost");
    }
}
