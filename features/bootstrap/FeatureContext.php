<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use PHPUnit_Framework_Assert as Assert;
use Hautelook\Cart;
use Hautelook\Product;

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
    public function iAddAPriceItemNamed($price, $productName)
    {
        $product = new Product($productName, $price);
        $this->cart->addProduct($product);
    }
    
    /**
     * @When I add a $:price :weight lb item named :productName
     */
    public function iAddAPriceWeightItemNamed($price, $weight, $productName)
    {
        throw new PendingException();
    }

    /**
     * @Then My subtotal should be $:price
     */
    public function mySubtotalShouldBePrice($price)
    {
        Assert::assertEquals($price, $this->cart->getSubtotal());
    }

    /**
     * @Then My total should be $:price
     */
    public function myTotalShouldBePrice($price)
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
     * @When I apply a :discount% coupon code
     */
    public function iApplyADiscountPercentCouponCode($discount)
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
