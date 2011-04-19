<?php

function process_form(){
	$page = isset($_POST["page"]) ? $_POST["page"] : ""; 
	$processed = true;
	
	switch ($page){
		case "purchase_new":
			require 'inc/process/purchase.php';
			purchase_add();
			break;
		case "store_edit":
			require 'inc/process/store.php';
			store_edit();
			break;
		case "user_new":
			require 'inc/process/user.php';
			user_add();
			break;
		default:
			$processed = false;
	}
	
	return $processed;
}

?>