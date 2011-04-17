<?php
require 'inc/class.purchase.php';
require 'inc/class.session.php';

function purchaseAdd(){
	$db = Database::getInstance();
	$session = Session::getInstance();
	$purchase = new Purchase();
	$descriptions = isset($_POST['description']) && is_array($_POST['description']) ? $_POST['description'] : false;
	$prices = isset($_POST['price']) && is_array($_POST['price']) ? $_POST['price'] : false;
	$quantity = isset($_POST['quantity']) && is_array($_POST['quantity']) ? $_POST['quantity'] : false;
	
	if (!$session->checkLogin())
		return false;
		
	for ($i=0; $i<count($prices); $i++){
		$detail = new PurchaseDetail();	
		$detail->line = $i+1;
		$detail->description = $db->escape($descriptions[$i]);
		$detail->price = $prices[$i];
		$detail->quantity = $quantity[$i];
		$purchase->detail[] = $detail;
	}
	
	$purchase->code = isset($_POST['code']) ? $db->escape($_POST['code']) : "";
	$purchase->date =  isset($_POST['date']) ? $_POST['date'] : "";
	$purchase->prepayment = isset($_POST['prepayment']) ? $_POST['prepayment'] : 0;
	$purchase->provider = isset($_POST['provider']) ? $db->escape($_POST['provider']) : ""; 
	$purchase->gloss = isset($_POST['gloss']) ? $db->escape($_POST['gloss']) : "";
	$purchase->userid = $session->uniqueid;
	
	if($purchase->Add()){
		header("Location: ".SITE_URL."index.php?pages=purchase_detail&purchase=$purchase->id");
	}
		
}
?>