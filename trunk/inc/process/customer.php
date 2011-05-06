<?php
require_once 'inc/class.customer.php';

function customer_add(){
	$customer = new Customer();
	
	$customer->name = isset($_POST['name']) ? $_POST['name'] : "";
	$customer->address = isset($_POST['address']) ? $_POST['address'] : "";
	$customer->phone = isset($_POST['phone']) ? $_POST['phone'] : "";
	$customer->cell = isset($_POST['cell']) ? $_POST['cell'] : "";
	$customer->active = isset($_POST['active']) ? $_POST['active'] : 0;
	$customer->email = isset($_POST['email']) ? $_POST['email'] : "";
	$customer->nit = isset($_POST['nit']) ? $_POST['nit'] : "";

	if ($customer->add()){
		$params = array("customer"=>$customer->id);
		header ("location: ".Forms::getLink(FORM_CUSTOMER_DETAIL, $params));
		exit();
	}
	
	return false;
}

function customer_edit(){
	$customer = new Customer();
	$customerid = isset($_POST['customerid']) ? $_POST['customerid'] : "";
	
	$customer->id = $customerid;
	$customer->name = isset($_POST['name']) ? $_POST['name'] : "";
	$customer->address = isset($_POST['address']) ? $_POST['address'] : "";
	$customer->phone = isset($_POST['phone']) ? $_POST['phone'] : "";
	$customer->cell = isset($_POST['cell']) ? $_POST['cell'] : "";
	$customer->active = isset($_POST['active']) ? $_POST['active'] : 0;
	$customer->email = isset($_POST['email']) ? $_POST['email'] : "";
	$customer->nit = isset($_POST['nit']) ? $_POST['nit'] : "";

	return $customer->update();
}
?>