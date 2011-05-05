<?php
require_once 'inc/class.customer.php';

function customer_add(){
	$customer = new Customer();
	$storeid = isset($_POST['storeid']) ? $_POST['storeid'] : "";
	
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
	$store = new Store();
	$storeid = isset($_POST['storeid']) ? $_POST['storeid'] : "";
	
	$store->id = $storeid;
	$store->name = isset($_POST['name']) ? $_POST['name'] : "";
	$store->address = isset($_POST['address']) ? $_POST['address'] : "";
	$store->contact = isset($_POST['contact']) ? $_POST['contact'] : "";
	$store->phone = isset($_POST['phone']) ? $_POST['phone'] : "";
	$store->active = isset($_POST['active']) ? 1 : 0;
	$store->fax = isset($_POST['fax']) ? $_POST['fax'] : "";
	$store->email = isset($_POST['email']) ? $_POST['email'] : "";
	$store->description = isset($_POST['description']) ? $_POST['description'] : "";

	if ($storeid == "new"){
		if ($store->add()){
			header ("location: index.php?pages=store_detail&store=$store->id");
			exit();
		}
	}
	else
		return $store->update();
	
	return false;
}
?>