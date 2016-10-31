<?php
namespace Hautelook;

/**
 * Collection of Item objects and defines related behaviors.
 * This class is designed to handle multiple items.
 *
 * @author
 */
class Items
{
	private $aItem = array();

	/**
	 * Add a product
	 * @param double $cost Price of a product to add.
	 * @param string $product_name Name of a product to add.
	 * @param double $lb Weight of a product to add.
	 */
	public function add($cost, $product_name, $lb=null)
	{
		try{
			$this->aItem[]= new Item($cost,$product_name, $lb);
		}catch(InvalidArgumentException $invalidArgumentException){
			throw InvalidArgumentException("Items::add(".$cost.", ".$product_name.", ".$lb."): ".$invalidArgumentException);
		}
	}

	/**
	 * Obtain greatest weight in pound (lb.) of all items.
	 * @return double Greatest weight in pound (lb.) of all items.
	 */
	public function getLbMax(){
		$aLb=array();
		foreach($this->aItem as $item){
			if(!is_null($item->getLb()))
			{
				$aLb[]= $item->getLb();
			}
		}
		return (double)max($aLb);
	}

	/**
	 * Obtain quantity of a specified product.
	 * @param string $product_name Name of a product to obtain quantity.
	 * @return int Quantity of the specified products.
	 */
	public function getQuantityOfProducts($product_name)
	{
		(int)$quantity=0;
		foreach($this->aItem as $item){
			if($product_name === $item->getProductName())
			{
				$quantity++;
			}
		}
		return (int)$quantity;
	}

	/**
	 * Obtain sum of quantity of added items which weight is lesser than specified weight in pound.(lb.)
	 * @param double $lb weight in pound(lb.) to specify the condition.
	 * @return int Sum of quantity of added items which weight is lesser than specified weight in pound.(lb.)
	 */
	public function getQuantitySumWhereLbLighter($lb){
		(int)$sum=0;
		foreach($this->aItem as $item){
			if(!is_null($item->getLb())&&!is_null($lb))
			{
				if($item->getLb()<$lb){
					$sum ++;
				}
			}
		}
		return (int)$sum;
	}

	/**
	 * Obtain sum of quantity of added items which weight is greater than specified weight in pound.(lb.)
	 * @param double $lb weight in pound(lb.) to specify the condition.
	 * @return int Sum of quantity of added items which weight is greater than specified weight in pound.(lb.)
	 */
	public function getQuantitySumWhereLbOrHeavier($lb){
		(int)$sum=0;
		foreach($this->aItem as $item){
			if(!is_null($item->getLb())&&!is_null($lb))
			{
				if($item->getLb()>=$lb){
					$sum ++;
				}
			}
		}
		return (int)$sum;
	}

	/**
	 * Obtain subtotal of all added items.
	 * @return double Subtotal in dollars of all added items.
	 */
	public function getSubtotal(){
		$subtotal=0;
		foreach($this->aItem as $item){
			$subtotal+=$item->getCost();
		}
		return (double)$subtotal;
	}

	/**
	 * Returns a string representation of this object.
	 * @return string A string representation of this object.
	 */
	public function __toString(){
		$stringValue="";
		foreach($this->aItem as $k=>$item){
			$stringValue .= (string)$item."\n";
		}
		return (string)$stringValue;
	}
}
