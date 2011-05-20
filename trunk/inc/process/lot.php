<?php
require_once 'inc/class.lot.php';

function lot_add(){
	$session = Session::getInstance();
	
	if (!$session->checkLogin())
		return false;
	
	$lot = new Lot();
	$lot->itemid = isset($_POST['itemid']) && is_numeric($_POST['itemid']) ? $_POST['itemid'] : 0;
	$lot->storeid = isset($_POST['storeid']) && is_numeric($_POST['storeid']) ? $_POST['storeid'] : 0;
	$lot->boxes = isset($_POST['box']) ? $_POST['box'] : 0;
	$lot->units = isset($_POST['units']) ? $_POST['units'] : 0;
	$lot->stock = isset($_POST['stock']) ? $_POST['stock'] : 0;
	$lot->active = isset($_POST['active']) ? $_POST['active'] : 0;
	$lot->cost = isset($_POST['costo']) ? $_POST['costo'] : 0;
	$lot->costMar = isset($_POST['tmar']) ? $_POST['tmar'] : 0;
	$lot->costTer = isset($_POST['tter']) ? $_POST['tter'] : 0;
	$lot->costAdu = isset($_POST['aduana']) ? $_POST['aduana'] : 0;
	$lot->costBank = isset($_POST['tbank']) ? $_POST['tbank'] : 0;
	$lot->costLoad = isset($_POST['cade']) ? $_POST['cade'] : 0;
	$lot->costOther = isset($_POST['other']) ? $_POST['other'] : 0;
	$lot->price = isset($_POST['pricef']) ? $_POST['pricef'] : 0;
	$lot->gloss = isset($_POST['notes']) ? $_POST['notes'] : '';

	if($lot->add())
		header("location:".Forms::getLink(FORM_LOT_DETAIL, array("lot" => $lot->id)));
	
	return false;
}
?>