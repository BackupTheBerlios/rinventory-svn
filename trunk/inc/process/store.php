<?php
require_once 'inc/class.store.php';

function store_edit(){
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

	if ($storeid == "new")
		$store->add();
	else
		return $store->update();
	
	return false;
}
?>