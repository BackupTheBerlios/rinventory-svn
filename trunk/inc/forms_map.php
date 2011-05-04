<?php
define('FORM_CUSTOMER_NEW', 'customer_edit');
define('FORM_CUSTOMER_EDIT', 'customer_edit');
define('FORM_CUSTOMER_DETAIL', 'customer_detail');
define('FORM_CUSTOMER_LIST', 'customer_list');

define('FORM_STORE_NEW', 'store_edit');
define('FORM_STORE_NEW', 'store_edit');

require_once 'inc/class.session.php';

class Forms{
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