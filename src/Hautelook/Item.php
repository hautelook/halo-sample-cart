<?php
namespace Hautelook;
use InvalidArgumentException;

/**
 * Hold attributes of single product item and defines related behaviors.
 * This class is designed to handle single item only.
 *
 * @author
 */
class Item
{
	private $product_name=null;
	private $cost=null;
	private $lb=null;

	/**
	 * Constructor
	 * @param double $cost Price of the product.
	 * @param string $product_name Name of the product.
	 * @param double $lb Weight in pound (lb.) of the single quantity of the product.
	 * @throws InvalidArgumentException When number of digits is greater than 13 or when given parameter,$doubleValue is not numeric.
	 */
	public function __construct($cost,$product_name, $lb=null)
	{
		try
		{
			NumberUtils::checkNumericValue($cost);
			$this->cost=(double)$cost;
		}
		catch(InvalidArgumentException $invalidArgumentException)
		{
			throw new InvalidArgumentException("Item::construct: Given value in parameter cost,'".$cost."' is not valid: ".$invalidArgumentException);
		}
		if(is_null($product_name)){
			throw new InvalidArgumentException("Item::construct: Given value in parameter product_name is null.");
		}else{
			if(strlen($product_name)){
				$this->product_name=(string)$product_name;
			}else{
				throw new InvalidArgumentException("Item::construct: Given value in parameter product_name is empty.");
			}
		}
		if(isset($lb))
		{
			try
			{
				NumberUtils::checkNumericValue($lb);
				$this->lb=(double)$lb;
			}
			catch(InvalidArgumentException $invalidArgumentException)
			{
				throw new InvalidArgumentException("Item::construct: Given value in parameter ls,'".$lb."' is not valid: ".$invalidArgumentException);
			}
		}
	}

	/**
	 * Obtain unit price of the product.
	 * @return double Price of the product.
	 */
	public function getCost(){
		return (double)$this->cost;
	}

	/**
	 * Obtain weight in pound (lb.) per product.
	 * @return double weight in pound (lb.) per product.
	 */
	public function getLb(){
		return (double)$this->lb;
	}

	/**
	 * Obtain product name of the item.
	 * @return string product name of the item.
	 */
	public function getProductName(){
		return (string)$this->product_name;
	}

	/**
	 * Returns a string representation of this object.
	 * @return string A string representation of this object.
	 */
	public function __toString(){
		$arr=array("product_name"=>$this->product_name, "item_cost"=>$this->item_cost, "lb"=>$this->lb);
		return (string)json_encode($arr);
	}
}
