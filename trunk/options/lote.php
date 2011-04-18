<?php
require_once 'inc/class.mysql.php';

$db = Database::getInstance(); 

$id=isset($_POST['id']) ? $_POST['id'] : "";
$name=$_POST['items'];
$box=$_POST['box'];
$units=$_POST['units'];
$stock=$_POST['stock'];
$active=isset($_POST['active']) ? $_POST['active'] : 0;
$almc=$_POST['almacen'];
$costo=$_POST['costo'];
$tmar=$_POST['tmar'];
$tter=$_POST['tter'];
$aduana=$_POST['aduana'];
$tbank=$_POST['tbank'];
$cade=$_POST['cade'];
$other=$_POST['other'];
$pricef=$_POST['pricef'];
//$freg=time('D:M:Y');
$notes=$_POST['notes'];
$res = FALSE;

//echo "La imagen subio correctamente"; 
if (isset($_POST['hw']))
	$res = $db->query("UPDATE ".TBL_LOT." SET name='$name', cajas='$box', unidades='$units',stock='$stock',active='$active',idalmacen='$almc', costo='$costo', tran_mar='$tmar', tran_ter='$tter', aduana='$aduana', trans_bank='$tbank', carga='$cade', otros='$other', price_final='$pricef', obs='$notes' where id='".$id."' ");	  
else 
	$res = $db->query("INSERT INTO ".TBL_LOT." VALUES('','$name','$box','$units','$stock','$active','$almc','$costo',NOW(),'admin','',NOW(),'$tmar','$tter','$aduana','$tbank','$cade','$other','$pricef','$notes')");
?>
<p class="form-title">Registro Aceptado Correctamente</p>