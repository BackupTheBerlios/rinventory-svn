<?php

function process_form(){
	$page = isset($_POST["page"]) ? $_POST["page"] : ""; 
	$processed = true;
	
	switch ($page){
		case FORM_CUSTOMER_NEW:
			require 'inc/process/customer.php';
			customer_add();
			break;
		case FORM_CUSTOMER_EDIT:
			require 'inc/process/customer.php';
			customer_edit();
			break;
		case FORM_PURCHASE_NEW:
			require 'inc/process/purchase.php';
			purchase_add();
			break;
		case FORM_PURCHASE_EDIT:
			require 'inc/process/purchase.php';
			purchase_edit();
			break;
		case "sell_new":
			require 'inc/process/sell.php';
			sell_add();
			break;
		case "sell_edit":
			require 'inc/process/sell.php';
			sell_edit();
			break;
		case "store_edit":
			require 'inc/process/store.php';
			store_edit();
			break;
		case "user_new":
			require 'inc/process/user.php';
			user_add();
			break;
		case "user_edit":
			require 'inc/process/user.php';
			user_edit();
			break;
		case FORM_LOT_NEW:
			require 'inc/process/lot.php';
			lot_add();
			break;
		default:
			$processed = false;
	}
	
	return $processed;
}

?>