<?php

function process_form(){
	$page = isset($_POST["page"]) ? $_POST["page"] : ""; 
	$processed = true;
	
	if (isset($_POST['error']))
		unset($_POST['error']);
	
	switch ($page){
		case "purchase_new":
			require 'inc/process/purchase.php';
			purchaseAdd();
			break;
		case "user_new":
			require 'inc/process/user.php';
			userAdd();
			break;
		default:
			$processed = false;
	}
	
	return $processed;
}

?>