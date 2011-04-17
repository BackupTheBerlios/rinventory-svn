<?php
if (!isset($_POST["source"]))
	die("Error, probable intento de ataque..");

switch ($_POST["source"]){
	case "purchase_new":
		require 'inc/process/purchase.php';
		purchaseAdd();
		break;
	case "user_new":
		require 'inc/process/user.php';
		userAdd();
		break;
}
?>