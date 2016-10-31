<?php

use Behat\Behat\Context\ClosuredContextInterface,
Behat\Behat\Context\TranslatedContextInterface,
Behat\Behat\Context\BehatContext,
Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
Behat\Gherkin\Node\TableNode;
use PHPUnit_Framework_Assert as Assert;
use Hautelook\Cart,
Hautelook\Item,
Hautelook\Items,
Hautelook\NumberUtils;

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{

	private $cart;
	private $shipping=0;
	private $must_apply_flat=false;
	private $flat_applied=false;

	/**
	 * Initializes context.
	 * Every scenario gets it's own context object.
	 *
	 * @param array $parameters context parameters (set them up through behat.yml)
	 */
	public function __construct(array $parameters)
	{
		$this->cart = new Cart();
	}

	/**
	 * @Given /^I have an empty cart$/
	 */
	public function iHaveAnEmptyCart()
	{
		$this->cart = new Cart();
	}

	/**
	 * @Then /^My subtotal should be "([^"]*)" dollars$/
	 */
	public function mySubtotalShouldBeDollars($subtotal)
	{
		$this->cart->setShipping();
		Assert::assertEquals($subtotal, $this->cart->subtotal());
	}

	/**
	 * @When /^I add a "([^"]*)" dollar item named "([^"]*)"$/
	 */
	public function iAddADollarItemNamed($dollars, $product_name)
	{
		$subtotal_orignal=$this->cart->subtotal();
		$this-> cart-> add($dollars, $product_name);
		$scaleDiscountRate = NumberUtils::getNumberOfFractionalDigits((double)100 - $this->cart-> getDiscountRate()) + 2;
		$scaleItemsSubtotal = NumberUtils::getNumberOfFractionalDigits((double)$this->cart->getItems()->getSubtotal()) + $scaleDiscountRate;
		$precision=2;
		$expected=(double)round(bcmul($this->cart->getItems()->getSubtotal(),bcdiv((double)100- $this->cart-> getDiscountRate(), 100,$scaleDiscountRate),$scaleItemsSubtotal),$precision);
		Assert::assertEquals($expected, $this->cart->subtotal());
	}

	/**
	 * @When /^I add a "([^"]*)" dollar "([^"]*)" lb item named "([^"]*)"$/
	 */
	public function iAddADollarItemWithWeight($dollars, $lb, $product_name)
	{
		$subtotal_orignal=$this->cart->subtotal();
		$this-> cart -> add($dollars, $product_name, $lb);
		Assert::assertEquals(round($subtotal_orignal+$dollars*(100-$this->cart-> getDiscountRate())/100,2), $this->cart->subtotal());
	}

	/**
	 * @Then /^My total should be "([^"]*)" dollars$/
	 */
	public function myTotalShouldBeDollars($total)
	{
		$this-> cart-> setShipping();
		Assert::assertEquals($total,$this->cart-> getTotal());
	}

	/**
	 * @Then /^My quantity of products named "([^"]*)" should be "([^"]*)"$/
	 */
	public function myQuantityOfProductsShouldBe($product_name, $quantity)
	{
		Assert::assertEquals($quantity, $this->cart->getQuantityOfProducts($product_name));
	}

	/**
	 * @Given /^I have a cart with a "([^"]*)" dollar item named "([^"]*)"$/
	 */
	public function iHaveACartWithADollarItem($item_cost, $product_name)
	{
		$this->cart-> add($item_cost, $product_name);
		Assert::assertEquals($item_cost, $this->cart->subtotal());
	}

	/**
	 * @When /^I apply a "([^"]*)" percent coupon code$/
	 */
	public function iApplyAPercentCouponCode($discount)
	{
		$subtotal_before_discount=$this-> cart -> subtotal();
		$this-> cart -> applyAPercentCouponCode($discount);
		$scaleDiscountRate = NumberUtils::getNumberOfFractionalDigits((double)100 - $this->cart-> getDiscountRate()) + 2;
		$scaleItemsSubtotal = NumberUtils::getNumberOfFractionalDigits((double)$this->cart->getItems()->getSubtotal()) + $scaleDiscountRate;
		$precision=2;
		Assert::assertEquals((double)round(bcmul($subtotal_before_discount,bcdiv(100-(double)$discount, 100,$scaleDiscountRate),$scaleItemsSubtotal),$precision),$this->cart->subtotal());
	}

	/**
	 * @Then /^My cart should have "([^"]*)" item\(s\)$/
	 */
	public function myCartShouldHaveItems($item_count)
	{
		throw new PendingException();
	}

	//Added variable(s) and functions
	
	private $invalidArgumentExceptionOccured=false;

	/**
	 * @When /^I add a "([^"]*)" dollar "([^"]*)" lb item named "([^"]*)", throws InvalidArgumentException$/
	 */
	public function iAddADollarItemWithWeightInvalidArgumentException($dollars, $lb, $product_name)
	{
		$subtotal_orignal=$this->cart->subtotal();
		try{
			$this-> cart -> add($dollars, $product_name, $lb);
			Assert::assertTrue(false);
			$this-> invalidArgumentExceptionOccured=false;
		}catch(InvalidArgumentException $invalidArgumentException){
			Assert::assertTrue(true);
			$this-> invalidArgumentExceptionOccured=true;
		}
	}

	/**
	 * @When /^I add a "([^"]*)" dollar item named "([^"]*)", throws InvalidArgumentException$/
	 */
	public function iAddADollarItemNamedInvalidArgumentException($dollars, $product_name)
	{
		$subtotal_orignal=$this->cart->subtotal();
		try{
			$this-> cart -> add($dollars, $product_name);
			Assert::assertTrue(false);
			$this-> invalidArgumentExceptionOccured=false;
		}catch(InvalidArgumentException $invalidArgumentException){
			Assert::assertTrue(true);
			$this-> invalidArgumentExceptionOccured=true;
		}
	}
	
	/**
	 * @When /^Numberic value is "([^"]*)", number of fractional digits is "([^"]*)"$/
	 */
	public function numberOfDigitCounterGetNumberOfFractionalDigits($doubleValue, $returnValue)
	{
		Assert::assertEquals($returnValue, NumberUtils::getNumberOfFractionalDigits($doubleValue));
	}

	/**
	 * @When /^Numberic value is "([^"]*)", throws InvalidArgumentException$/
	 */
	public function numberOfDigitCounterGetNumberOfFractionalDigitsInvalidArgumentException($doubleValue)
	{
		try{
			NumberUtils::getNumberOfFractionalDigits($doubleValue);
			Assert::assertTrue(false);
			$this-> invalidArgumentExceptionOccured=false;
		}catch(InvalidArgumentException $invalidArgumentException){
			Assert::assertTrue(true);
			$this-> invalidArgumentExceptionOccured=true;
		}
	}
	
	/**
	 * @Then /^InvalidArgumentException Occured: "([^"]*)"$/
	 */
	public function InvalidArgumentExceptionOccured($yes_no)
	{
		if($this-> invalidArgumentExceptionOccured)
		{
			Assert::assertEquals($yes_no,"yes");
		}else{
			Assert::assertEquals($yes_no,"no");
		}
		$this-> invalidArgumentExceptionOccured = false;
	}
}
