<?php
if (!isset($_POST["source"]))
	die("Error, probable intento de ataque..");

switch ($_POST["source"]){
	case "purchase_new":
		require 'inc/purchase.php';
		purchaseAdd();
		break;
	case "user_new":
		require 'inc/user.php';
		userAdd();
		break;
}
?>