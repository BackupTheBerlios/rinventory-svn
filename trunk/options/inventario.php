<?php
require_once 'inc/class.session.php';
require_once 'inc/class.mysqli.php';

$session = Session::getInstance();
$db = Database::getInstance();

if (isset($_POST['iditem']))
	$iditem=$_POST['iditem'];

$usid = $session->uniqueid;
$titem=$_GET['item'];
$item=$_POST['items'];         
$name=$_POST['name'];
$material=isset($_POST['material']) ? $_POST['material'] : "";
$color = isset($_POST['color']) ? $_POST['color'] : '';
$marker= isset($_POST['marker']) ? $_POST['marker'] : '';  
$regr = isset($_POST['regr']) ? $_POST['regr'] : 0;
$punit=$_POST['price_unit'];
$ppaq=$_POST['price_paq'];
$pbox=$_POST['price_box'];
//$datelote=$_POST['date_lote']; //delete field from form
$stockmin=$_POST['stockmin'];
$sql = "";
  
$notas = isset($_POST['notas']) ? $_POST['notas'] : '';
$upload = isset($_POST['upload']) ? $_POST['upload'] : ''; 
$result = FALSE;
  
if($titem=='multiple') {
   $velocity=$_POST['velocity'];
   $paquete=$_POST['paquete'];
   $envase=$_POST['envase'];
   $capacidad=$_POST['capacidad'];
   $ruta="";
   
	if ($_FILES['upload']['name']) {
		$ruta = "img/items/" . $_FILES['upload']['name']; 
		copy($_FILES['upload']['tmp_name'], $ruta);
	}
   
	if (isset($_GET['hw']))
		$sql = "UPDATE ".TBL_ITEM." SET v_descr='$name', material='', link_marca='$marker', link_color='', price_unit='$punit', price_paq='$ppaq', price_box='$pbox', rewrite='$regr', stock_total='$stocktot', stock_min='$stockmin', v_60_1='$velocity', v_60_2='$paquete', v_60_3='$envase', v_60_4='$capacidad', link_user='$usid', image='$ruta', last_update='', description='$notas' where id='".$iditem."'";
	else 
		$sql = "INSERT INTO ".TBL_ITEM." ".
			"(`link_type_item`,`v_descr`,`material`,".
			"`link_marca`,`link_color`,`price_unit`,".
			"`price_paq`,`price_box`,`rewrite`,".
			"`stock_total`,`stock_min`,`v_60_1`,".
			"`v_60_2`,`v_60_3`,`v_60_4`,".
			"`v_60_5`,`v_60_6`,`link_user`,".
			"`link_for`,`image`,`last_update`,`description`)".
			" VALUES ".
			"('$item','$name','',".
			"'$marker','',$punit,".
			"$ppaq,$pbox,'$regr',".
			"0,'$stockmin','$velocity',".
			"'$paquete','$envase','$capacidad',".
			"'','',$usid,".
			"'','$ruta',NOW(),'$notas')"; 

	$result = $db->query($sql); 
}
else if($titem=='normal') {
	$spar = isset($_POST['spara']) ? $_POST['spara'] : '';
	$tstch = isset($_POST['tstch']) ? $_POST['tstch'] : '';
	$spesor = isset($_POST['espes']) ? $_POST['espes'] :'';
	$ruta="";
	
    if ($_FILES['upload']['name']) {
		$ruta = "img/items/" . $_FILES['upload']['name']; 
		copy($_FILES['upload']['tmp_name'], $ruta);
	} 
 
	if (isset($_GET['hw']))
		$result = $db->query("UPDATE ".TBL_ITEM." SET v_descr='$name', material='$material', link_marca='$marker', link_color='$color', price_unit='$punit', price_paq='$ppaq', price_box='$pbox', rewrite='', stock_total='$stocktot', stock_min='$stockmin', v_60_5='$spesor', v_60_6='$tstch', link_user='$usid', link_for='$spar', image='$ruta', last_update='', description='$notas' where id='".$iditem."'");
    else {
		$result = $db->query("INSERT INTO ".TBL_ITEM." (
`link_type_item` ,
`v_descr` ,
`material` ,
`link_marca` ,
`link_color` ,
`price_unit` ,
`price_paq` ,
`price_box` ,
`rewrite` ,
`stock_total` ,
`stock_min` ,
`v_60_1` ,
`v_60_2` ,
`v_60_3` ,
`v_60_4` ,
`v_60_5` ,
`v_60_6` ,
`link_user` ,
`link_for` ,
`image` ,
`last_update` ,
`description`
)
VALUES (
'$item', '$name', '$material', '$marker', '$color', '$punit', '$ppaq', '$pbox', '', 0, '$stockmin', '0', '1', '2', '3', '$spesor', '$tstch', 'admin', '$spar', '$ruta', NULL , '$notas');"); 
  }
 } 
  
if($titem=='stnd') {
	$ruta="";
    
	if ($_FILES['upload']['name']) {
		$ruta = "img/items/" . $_FILES['upload']['name']; 
		copy($_FILES['upload']['tmp_name'], $ruta);
	}
	
	if (isset($_GET['hw']))
		$result = $db->query("UPDATE dvd_item SET v_descr='$name', material='$material', link_marca='$marker', link_color='$color', price_unit='$punit', price_paq='$ppaq', price_box='$pbox', rewrite='', stock_total='$stocktot', stock_min='$stockmin', link_user='$usid', image='$ruta', last_update='', description='$notas' where id='".$iditem."'");
	else { 
		$result = $db->query("INSERT INTO ".TBL_ITEM." (
`link_type_item` ,
`v_descr` ,
`material` ,
`link_marca` ,
`link_color` ,
`price_unit` ,
`price_paq` ,
`price_box` ,
`rewrite` ,
`stock_total` ,
`stock_min` ,
`v_60_1` ,
`v_60_2` ,
`v_60_3` ,
`v_60_4` ,
`v_60_5` ,
`v_60_6` ,
`link_user` ,
`link_for` ,
`image` ,
`last_update` ,
`description`
)
VALUES (
'$item',  '$name',  '$material',  '$marker',  '$color',  '$punit',  '$ppaq',  '$pbox',  '',  '$stocktot',  '$stockmin',  '0',  '1',  '2',  '3',  '4',  '5',  'admin',  '', '$ruta' , NULL ,  '$notas');"); 
     }
  }
 	
header("Location: " . SITE_URL . "index.php?pages=inventario_list&msg=".($result === TRUE ? "success" : "failed"));
exit; 
 
?>
