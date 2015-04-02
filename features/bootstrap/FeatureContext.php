<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use PHPUnit_Framework_Assert as Assert;
use Hautelook\Cart;

class FeatureContext implements Context
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @Given I have an empty cart
     */
    public function iHaveAnEmptyCart()
    {
        $this->cart = new Cart();
    }

    /**
     * @When I add a $:price item named :productName
     */
    public function iAddADollarItemNamed($price, $productName)
    {
        throw new PendingException();
    }

    /**
     * @When I add a $:price :weight lb item named :productName
     */
     public function iAddADollarItemWithWeight($dollars, $lb, $product_name)
     {
         throw new PendingException();
     }

     /**
      * @Then My subtotal should be $:subtotal dollars
      */
     public function mySubtotalShouldBeDollars($subtotal)
     {
         Assert::assertEquals($subtotal, $this->cart->subtotal());
     }

    /**
     * @Then My total should be $:total dollars
     */
    public function myTotalShouldBeDollars($total)
    {
        throw new PendingException();
    }

    /**
     * @Then My quantity of products named :productName should be :quantity
     */
    public function myQuantityOfProductsNamedShouldBe($productName, $quantity)
    {
        throw new PendingException();
    }


    /**
     * @Given I have a cart with a $:price item named :productName
     */
    public function iHaveACartWithAPriceItemNamed($price, $productName)
    {
        throw new PendingException();
    }

    /**
     * @When I apply a :percent% coupon code
     */
    public function iApplyAPercentCouponCode($percent)
    {
        throw new PendingException();
    }

    /**
     * @Then My cart should have :itemCount item(s)
     */
    public function myCartShouldHaveItems($itemCount)
    {
        throw new PendingException();
    }
}
