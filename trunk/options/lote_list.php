<style>
.st_tbcss,.st_tdcss,.st_divcss,.st_ftcss{border:none;padding:0px;margin:0px}
A.st_acss,A.st_acss:link,A.st_acss:visited,A.st_acss:active,A.st_acss:hover{background-color:transparent;font-style:normal;border:none}
</style>
<?php
$itemid = isset($_GET['itemid']) ? $_GET['itemid'] : -1;
$storeid = isset($_GET['storeid']) ? $_GET['storeid'] : false; 

$res = $db->query("SELECT v_descr as name FROM ".TBL_ITEM." WHERE id=$itemid");
$row = $db->getRow($res, 0);
?>
<!-- end top_menu.inc.htm -->
<!-- start toolbar.inc.htm -->

<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td class="menudottedline" width="40%"><div class="pathway"><a href="index.php?option=home" class="headerNavigation">Panel de Control</a> <?php echo SB_BREADCRUMB;?> <a href="index.php?pages=lote_list" class="headerNavigation">Lote</a></div></td>
	<td class="menudottedline" align="right">
		<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
		<tr align="center" valign="middle">
		<!-- start icons_toolbar.inc.htm -->
			<td><a class="toolbar" href="javascript:submitbutton('new');" onClick=""> <img src="img/sweb/new_f2.png" alt="Nuevo" name="new" align="middle" border="0"> <br> Nuevo</a> </td>
			<td>&nbsp;</td>
			<td><a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Por favor haga una selección de la lista a eliminar'); } else if (confirm('¿Esta seguro que desea eliminar los items seleccionados? ')){ submitbutton('remove');}" onClick=""> <img src="img/sweb/delete_f2.png" alt="Borrar" name="delete" align="middle" border="0"> <br>Borrar</a> </td>
			<td>&nbsp;</td>
		<!-- end icons_toolbar.inc.htm -->
		</tr>
		</table>
	</td>
</tr>
</table>

<!-- end toolbar.inc.htm -->
<!-- start company.inc.htm -->

<div class="centermain" align="center">
	<div class="main">
    <!-- start form_departamentos_list.inc.htm -->
		<table class="adminheading">
		<tbody>
		<tr>
			<th class="categories"><img src="img/sweb/almacenes.png" width="48" height="48" name="logo_Departamentos" border="0" class="icon-png" alt="Departamentos"/>Lotes: <span id="filter"><?php echo $row['name'];?></span></th>
		</tr>
		</tbody>
		</table>
		
		<form action="index.php" method="GET">
			<input type="hidden" name="pages" value="lote_list"/>
			<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
			Ver lotes por almacen:
			<select name="storeid">
			<option value="">- Todos -</option>
<?php 
$res = $db->query("SELECT id, name FROM ".TBL_DEPARTMENT." ORDER BY name");

while($row = $db->getRow($res, 0)){
	echo "<option value=\"{$row['id']}\"". (isset($_GET['storeid']) && $_GET['storeid']==$row['id'] ? " selected=\"selected\"" : "") . ">{$row['name']}</option>";
}
?>
			</select>
			<input type="submit" value="Aceptar"/>
		</form>
		
		<form action="index.php?pages=lote_new" method="post" name="adminForm">
			<table class="adminlist">
			<tr>
				<th class="title" width="25"> <a href="javascript: listOrder('0');void(0);"><img src="img/sweb//pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"></a> </th>
				<th width="20"> <input name="toggle" value="" onClick="checkAll(2);" type="checkbox"></th>
				<th>&nbsp;</th>
				<th class="title"> <a href="javascript: listOrder('1');void(0);">Almacen </a><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/> </th>
				<th width="70"> <a href="javascript: listOrder('2');void(0);">Active </a><img src="img/sweb/sort_asc.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/> </th>
				<th></th>
				<th align="left"> <a href="javascript: listOrder('3');void(0);">Stock</a><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"> </th>
				<th align="left"> <a href="javascript: listOrder('4');void(0);">Precio Final</a><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"> </th>
				<th>&nbsp;</th>
<?php
$res = $db->query("SELECT dl.id, ".
	"di.link_type_item as name, ".
	"dl.idalmacen, ".
	"dd.name store, ".
	"di.material, ".
	"dl.stock, ".
	"dl.active, ".
	"dl.price_final ".
	"FROM ".TBL_LOT." dl INNER JOIN ".TBL_ITEM." di ON dl.name=di.id INNER JOIN ".TBL_DEPARTMENT." dd ON dd.id=dl.idalmacen ".
	"WHERE di.id=$itemid AND dl.stock>0 ".	($storeid ? "AND dd.id=$storeid" : ""));

$sw=0;
$cnt=1;

while($row = $db->getRow($res, 0)) {
	$sim="tick.png";
	
	if($row['active']==0)
		$sim="publish_x.png";  
?>
			</tr>
			<tr class="row<?php echo $sw;?>">
				<td align="center"> <?php echo $row['id']; ?> </td>
				<td><input id="cb0" name="cid[]" value="15" onClick="isChecked(this.checked);" type="checkbox"> </td>
				<td></td>
				<td align="left"><?php echo $row['store']; ?></td>
				<td align="center"><a href="javascript: void(0);" onClick="return listItemTask(&#39;cb0&#39;,&#39;inactive&#39;)" title="Activo"><img src="img/sweb/<?php echo $sim;?>" alt="Activo" border="0"></a> </td>
				<td></td>
				<td align="left"><?php echo $row['stock'];?></td>
				<td align="left"><?php echo $row['price_final'];?></td>
				<td><a href="index.php?pages=modify_lot&id=<?php echo $row['id'];?>"><img src="img/sweb/application_form_edit.png" border="0"/></a></td>
			</tr>
<?php 
	$sw = $sw == 0 ? 1 :0;	
	$cnt++;        
} 
?>     	  
			</table>
<?php
$res = $db->query("SELECT dl.idalmacen, ".
	"SUM(dl.stock) stock ".
	"FROM ".TBL_LOT." dl INNER JOIN ".TBL_ITEM." di ON dl.name=di.id ".
	"WHERE di.id=$itemid AND dl.active=1 ".	
	($storeid ? "AND dl.idalmacen=$storeid " : "").
	"GROUP BY dl.idalmacen");

	
$stockTotal = 0;
while ($row = $db->getRow($res, 0)){
	$stockTotal += $row['stock'];
 }
?>

			<table class="adminlist">
			<tr>
				<td>Stock Total: <?php echo $stockTotal;?></td>
			</tr>
			</table>

			<input name="option" value="com_departamentos" type="hidden">
			<input name="section" value="" type="hidden">
			<input name="task" value="" type="hidden">  
			<input name="chosen" value="" type="hidden">
			<input name="act" value="" type="hidden">
			<input name="boxchecked" value="0" type="hidden">
			<input name="type" value="list" type="hidden">
			<input name="order" type="hidden" id="order" value="{FORM_ORDER_BY}">
			<input name="flag_order" type="hidden" id="flag_order" value="0">
		</form>

	<!-- end form_departamentos_list.inc.htm -->
	</div>
</div>
