<?php

  //echo "name: ".$_POST['name'].' - '.$_POST['contact_name'].' - '.$_POST['active'];
if (isset($_POST['iditem']))
	$iditem=$_POST['iditem'];
 
$usid=$_POST['userid'];
$titem=$_GET['item'];
$item=$_POST['items'];         
$name=$_POST['name'];
$material=$_POST['material'];
$color = isset($_POST['color']) ? $_POST['color'] : '';
$marker= isset($_POST['marker']) ? $_POST['marker'] : '';  
$regr = isset($_POST['regr']) ? $_POST['regr'] : 0;
$punit=$_POST['price_unit'];
$ppaq=$_POST['price_paq'];
$pbox=$_POST['price_box'];
//$datelote=$_POST['date_lote']; //delete field from form
$stockmin=$_POST['stockmin'];
  
$notas = isset($_POST['notas']) ? $_POST['notas'] : '';
$upload = isset($_POST['upload']) ? $_POST['upload'] : ''; 
$userid=$_POST['userid'];
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
		$result = $db->query("UPDATE ".TBL_ITEM." SET v_descr='$name', material='', link_marca='$marker', link_color='', price_unit='$punit', price_paq='$ppaq', price_box='$pbox', rewrite='$regr', stock_total='$stocktot', stock_min='$stockmin', v_60_1='$velocity', v_60_2='$paquete', v_60_3='$envase', v_60_4='$capacidad', link_user='$usid', image='$ruta', last_update='', description='$notas' where id='".$iditem."'");
	else {
		$result = $db->query("INSERT INTO ".TBL_ITEM." ".
			"(`link_type_item`,`v_descr`,`material`,`link_marca`,`link_color`,`price_unit`,`price_paq`,`price_box`,`rewrite`,`stock_total`,`stock_min`,`v_60_1`,`v_60_2`,`v_60_3`,`v_60_4`,`v_60_5`,`v_60_6`,`link_user`,`link_for`,`image`,`last_update`,`description`)".
			" VALUES ".
			"'$item','$name','','$marker','','$punit','$ppaq','$pbox','$regr',0,'$stockmin','$velocity','$paquete','$envase','$capacidad','','','admin','','$ruta',NULL,'$notas');"); 
	}
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

<div class="centermain" align="center">
  <div class="main">
    <!-- start form_departamentos_edit.inc.htm -->
    <script language="JavaScript" src="js/overlib_mini.js" type="text/javascript"></script>
    <link href="css/media.css" rel="stylesheet" type="text/css" />
    <table class="adminheading">
      <tbody>
        <tr>
          <th class="categories">
              <img src="img/sweb/user.png" alt="Departamentos" name="logo_Departamentos" width="48" height="48" border="0" class="icon-png" id="logo_Departamentos" /> Usuario</th>
        </tr>
      </tbody>
    </table>
    <form action="index.php?pages=almacen" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm">
      <table class="adminform">
        <!--DWLayoutTable-->
        <tbody>
          <tr>
            <th colspan="3">Informe</th>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td rowspan="8" valign="top"></td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td>Se Registro Exitosamente!. <img src="img/sweb/tick.png">&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td>&nbsp;<a href="index.php?option=home">Volver Home</a> </td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr>
            <td width="250" rowspan="2" valign="top" nowrap="nowrap"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="445" height="1"></td>
            <td></td>
          </tr>
          <tr>
            <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td></td>
          </tr>
          <tr>
            <td colspan="3"><br />
                <input name="option" value="com_departamentos" type="hidden" />
                <input name="section" value="" type="hidden" />
                <input name="task" value="" type="hidden" />
                <input name="id" type="hidden" id="id" value="" />
                <input name="dirPath" type="hidden" i12128500Path" value="" />
                <input name="hidemainmenu" value="0" type="hidden" /></td>
          </tr>
        </tbody>
      </table>
    </form>
    <!-- end form_departamentos_edit.inc.htm -->
  </div>
</div>
