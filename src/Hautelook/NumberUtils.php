<?php
namespace Hautelook;
use InvalidArgumentException;

/**
 * Utilities to check and analyze numeric values.
 *
 *
 */
class NumberUtils{

	/**
	 * Check if the given numeric can be handled.
	 * @param doulbe $doubleValue Numeric value to check. (Accepts number only up to 13 digits, including both integer and fraction part.)
	 * @throws InvalidArgumentException When number of digits is greater than 13 or when given parameter,$doubleValue is not numeric.
	 * @return boolean true If the given numeric value is acceptable.
	 */
	public static function checkNumericValue($doubleValue){
		try{
			$numberOfDigit=self::getNumberOfDigit($doubleValue);
		}catch(InvalidArgumentException $invalidArgumentException){
			throw new InvalidArgumentException("NumberUtils::getNumberOfFractionalDigits: Given value in doubleValue, '".$doubleValue."' is not numeric.");
			return false;
		}
		if($numberOfDigit>13){
			throw new InvalidArgumentException("NumberUtils::getNumberOfFractionalDigits: Number of digit of the given value, ".$doubleValue." is ".$numberOfDigit.". This is greater than 13.");
			return false;
		}
		return true;
	}

	/**
	 *
	 * Obtain number of digits, sum of number of digits of integer part and fraction part.
	 * @param double $doubleValue Numeric value to obtain the number of digit.
	 * @throws InvalidArgumentException When given parameter,$doubleValue is not numeric.
	 * @return int Number of digits.
	 */
	private static function getNumberOfDigit($doubleValue){
		if(is_numeric($doubleValue)){
			$doubleValue=abs($doubleValue);
			$numberOfDigit=strlen(str_replace(".", "",(string)(double)$doubleValue));
			if(substr((string)(double)$doubleValue,0,2)=="0.")$numberOfDigit--;
			return $numberOfDigit;
		}else{
			throw new InvalidArgumentException("NumberUtils::getNumberOfDigit: Given value in doubleValue, '".$doubleValue."' is not numeric.");
		}
	}

	/**
	 * Obtain number of digits of fraction part.
	 * @param doulbe $doubleValue Double value to obtain number of digits of fraction part.(Accepts number only up to 13 digits, including both integer and fraction part.)
	 * @throws InvalidArgumentException When number of digits is greater than 13 or when given parameter,$doubleValue is not numeric.
	 * @return int number of digits of fraction part.
	 */
	public static function getNumberOfFractionalDigits($doubleValue){
		if(self::checkNumericValue($doubleValue)){
			$aStringValue=preg_split('@[/\.]@', (string)(double)$doubleValue);
			$numberOfFractionalDigits=0;
			if(count($aStringValue)==2){
				$numberOfFractionalDigits=strlen($aStringValue[1]);
			}
			return $numberOfFractionalDigits;
		}else{
			return null;
		}
	}
}
