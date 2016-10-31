<?php
namespace Hautelook;

/**
 * Defines behavior of the shopping cart.
 *
 * @author
 */
class Cart
{
	private $discountRate=0;
	private $flat=0;
	private $items;
	private $shipping=0;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->items=new Items();
	}

	/**
	 * Add a product
	 * @param double $dollars Price of a product to add.
	 * @param string $product_name Name of a product to add.
	 * @param double $lb Weight of a product to add.
	 */
	public function add($cost, $product_name, $lb=null)
	{
		//Check if the given numeric can be handled.
		$itemsSubtotal = $this->items->getSubtotal() + $cost;
		$subtotal = $this->getSubtotal($itemsSubtotal);
		$total = (double)round($subtotal + $this->shipping + $this->flat,2);
		try{
			NumberUtils::checkNumericValue($itemsSubtotal);	//check items subtotal
			NumberUtils::checkNumericValue($subtotal);//check subtotal
			NumberUtils::checkNumericValue($total); //check total
		}catch(InvalidArgumentException $invalidArgumentException){
			throw InvalidArgumentException("Cart::add(".$cost.", ".$product_name.", ".$lb."): ".$invalidArgumentException);
		}
		//Add
		$this->items->add($cost, $product_name, $lb);
	}

	/**
	 * Set discount rate specified.
	 * @param doulbe $discount Discount rate in percentage.
	 */
	public function applyAPercentCouponCode($discountRate){
		$this->discountRate = (double)$discountRate;
	}

	/**
	 * Obtain the discount rate.
	 * @retun double discount rate.
	 */
	public function getDiscountRate(){
		return (double)$this->discountRate;
	}

	/**
	 *
	 * Obtain collection of Item class instances which is added by add function.
	 * @return Items collection of Item class instances which is added by add function.
	 */
	public function getItems(){
		return $this->items;
	}

	/**
	 * Obtain quantity of a specified product.
	 * @param string $product_name Name of a product to obtain quantity.
	 * @return int Quantity of the specified products.
	 */
	public function getQuantityOfProducts($product_name)
	{
		return (int)$this->items->getQuantityOfProducts($product_name);
	}

	/**
	 * Obtain total payment amount which is sum of subtotal, shipping fee and flat rate.
	 * @return double Total payment amount.(Rounded to two decimal places.)
	 */
	public function getTotal()
	{
		return (double)round($this->subtotal() + $this->shipping+$this->flat,2);
	}

	/**
	 * Set shipping fee and flat rate.
	 */
	public function setShipping(){
		if($this->items->getSubtotal() >= 100 && $this->items ->getLbMax()<10)
		{//Scenario: When order is $100 or more, and each individual item is under 10 lb, then shipping is free
			$this->shipping = (double)0;
		}else{
			if($this->items->getQuantitySumWhereLbOrHeavier(10) > 0)
			{//Scenario: Items that are 10 lb or more always cost $20 each to ship
				$this->shipping = (double)$this->items ->getQuantitySumWhereLbOrHeavier(10) * 20;
			}
			if($this->items->getSubtotal() < 100
			&& $this->items->getQuantitySumWhereLbLighter(10)>0)
			{//Scenario: When order is under $100, and all items under 10 lb, then shipping is $5 flat
				$this->flat =5;
			}
			//Scenario: When order is under $100, and all items are 10 lb or more, then flat rate should not be charged > covered by previous conditions
		}
	}

	/**
	 * Obtain subtotal of all items in dollars.
	 * @return double Subtotal of all items in dollars.(Rounded to two decimal places.)
	 */
	public function subtotal()
	{
		return $this->getSubtotal($this->items->getSubtotal());
	}

	/**
	 * Obtain subtotal of all items in dollars.
	 * @param $itemSubtotal Subtotal(sum) of items cost only
	 * @return double Subtotal of all items in dollars.(Rounded to two decimal places.)
	 */
	private function getSubtotal($itemSubtotal)
	{
		$scaleDiscountRate = NumberUtils::getNumberOfFractionalDigits((double)100 - $this->discountRate) + 2;
		$scaleItemsSubtotal = NumberUtils::getNumberOfFractionalDigits((double)$itemSubtotal) + $scaleDiscountRate;
		$precision=2;
		return (double)round(bcmul((double)$itemSubtotal,bcdiv((double)100-$this->discountRate, (double)100,$scaleDiscountRate),$scaleItemsSubtotal),$precision);
	}

	/**
	 * Returns a string representation of this object.
	 * @return string A string representation of this object.
	 */
	public function __toString(){
		return (string)$this->items;
	}
}
