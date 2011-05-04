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
			break;
		case "purchase_new":
			require 'inc/process/purchase.php';
			purchase_add();
			break;
		case "purchase_edit":
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
		default:
			$processed = false;
	}
	
	return $processed;
}

?>