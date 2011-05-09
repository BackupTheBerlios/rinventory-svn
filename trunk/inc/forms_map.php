<?php
define('FORM_CUSTOMER_NEW', 'customer_new');
define('FORM_CUSTOMER_EDIT', 'customer_edit');
define('FORM_CUSTOMER_DETAIL', 'customer_detail');
define('FORM_CUSTOMER_LIST', 'customer_list');

define('FORM_USER_NEW', 'user_new');
define('FORM_USER_EDIT', 'user_edit');
define('FORM_USER_LIST', 'user_list');
define('FORM_USER_DETAIL', 'user_detail');

define('FORM_SELL_NEW', 'sell_new');
define('FORM_SELL_EDIT', 'sell_edit');
define('FORM_SELL_LIST', 'sell_list');
define('FORM_SELL_DETAIL', 'sell_detail');
define('FORM_SELL_OUTSTANDING', 'sell_outstanding');

define('FORM_STORE_NEW', 'store_edit');

require_once 'inc/class.session.php';

class Forms{
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $form
	 * @param unknown_type $params
	 */
	public static function getLink($form, $params=""){
		$str = "";
		
		if (is_array($params)){
			foreach ($params as $key => $value){
				$str .= "&$key=$value";
			}
		}
		else if (is_string($params))
			$str = $params;
		
		return SITE_URL."index.php?pages=$form".$str;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $currentSortField
	 * @param unknown_type $sortField
	 * @param unknown_type $sortOrder
	 */
	public static function getSort($currentSortField, $sortField, $sortOrder){
		$array = array();
		
		$array['sort_by'] = $sortField;
		
		if ($currentSortField == $sortField)
			$array['sort_dir'] = $sortOrder == "d" ? "a" : "d";
		else 
			$array['sort_dir'] = "a";
		
		return $array;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $form
	 */
	public static function checkPermission($form){
		if (!Forms::isAllowed($form)){
			echo "Acceso Denegado.";
			return false;
		}
		
		return true;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $form
	 */
	public static function isAllowed($form){
		$session = Session::getInstance();
		
		switch ($session->userlevel) {
			case ADMIN_LEVEL:
				return true;
			case USER_LEVEL;
				return Forms::isUserAllowed($form);
		}
		
		return false;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $form
	 */
	private static function isUserAllowed($form){
		switch ($form) {
			case FORM_CUSTOMER_NEW:
			case FORM_CUSTOMER_EDIT:
				return false;
			case FORM_CUSTOMER_LIST:
			case FORM_CUSTOMER_DETAIL:
				return true;
		}
		
		return false;	
	}
}
?>