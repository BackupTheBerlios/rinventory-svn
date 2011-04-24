<?php

/**
 * 
 * @author luis
 *
 */
class Formatter {
	
	/**
	 * 
	 * @param unknown_type $number
	 */
	public static function number($number){
		return number_format($number, 2);
	}
	
	/**
	 * 
	 * @param unknown_type $number
	 */
	public static function currency($number){
		return SB_CURRENCY." ".Formatter::number($number);
	}
	
	/**
	 * 
	 * @param unknown_type $date
	 */
	public static function date($date){
		return $date;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $text
	 * @param unknown_type $max
	 */
	public static function text($text, $max=50){
		if (strlen($text) > $max)
			return substr($text, 0, $max) . "...";
		
		return $text;
	}
}
?>