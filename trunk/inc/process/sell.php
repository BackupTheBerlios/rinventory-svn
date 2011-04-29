<?php
require 'inc/class.sell.php';

function sell_add(){
	$db = Database::getInstance();
	$session = Session::getInstance();
	$sell = new Sell();
	$lots = isset($_POST['lot']) && is_array($_POST['lot']) ? $_POST['lot'] : false;
	$prices = isset($_POST['price']) && is_array($_POST['price']) ? $_POST['price'] : false;
	$quantity = isset($_POST['quantity']) && is_array($_POST['quantity']) ? $_POST['quantity'] : false;
	$unit_types = isset($_POST['unit_type']) ? $_POST['unit_type'] : '';
	
	 
	if (!$session->checkLogin())
		return false;
		
	for ($i=0; $i<count($prices); $i++){
		$detail = new SellDetail();	
		$detail->line = $i+1;
		$detail->price = $prices[$i];
		$detail->quantity = $quantity[$i];
		$detail->lotid = $lots[$i];
		$detail->unit = $unit_types[$i]; 
		$sell->detail[] = $detail;
	}
	
	$sell->date =  isset($_POST['date']) ? $_POST['date'] : "";
	$sell->paymentType = isset($_POST['payment_type']) ? $_POST['payment_type'] : "";
	$sell->prepayment = isset($_POST['prepayment']) ? $_POST['prepayment'] : 0;
	$sell->customer = isset($_POST['customer']) ? $db->escape($_POST['customer']) : ""; 
	$sell->nit = isset($_POST['nit']) ? $db->escape($_POST['nit']) : "";
	$sell->gloss = isset($_POST['gloss']) ? $db->escape($_POST['gloss']) : "";
	$sell->storeid = isset($_POST['store']) ? $_POST['store'] : "";
	
	if($sell->Add()){
		header("Location: ".SITE_URL."index.php?pages=sell_detail&sell=$sell->id");
	}		
}

function sell_edit(){
	$session = Session::getInstance();
	
	if (!$session->checkLogin())
		return false;
	
	$sell = new Sell();
	$sell->id = isset($_POST['sell']) ? $_POST['sell'] : "";
	$sell->status = isset($_POST['status']) ? $_POST['status'] : "";
	$sell->update();
	
	if (isset($_POST['payment']) && is_numeric($_POST['payment'])){
		$sellPayment = new SellPayment();
		$sellPayment->sellid = isset($_POST['sell']) ? $_POST['sell'] : "";
		$sellPayment->amount = isset($_POST['payment']) ? $_POST['payment'] : "";
		$sellPayment->add();
	}
}
?>