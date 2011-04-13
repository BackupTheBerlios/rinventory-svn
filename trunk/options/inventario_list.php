<!-- start top_menu.inc.htm -->
<!-- end top_menu.inc.htm -->
<!-- start toolbar.inc.htm -->

<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td class="menudottedline" width="40%"><div class="pathway"><a href="./index.php?option=home" class="headerNavigation">Panel de Control</a> <?php echo SB_BREADCRUMB; ?> <a href="./index.php?pages=inventario_list" class="headerNavigation">Inventario</a></div></td>
	<td class="menudottedline" align="right">
		<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
		<tr align="center" valign="middle">
		<!-- start icons_toolbar.inc.htm -->
			<td><a class="toolbar" href="javascript:hideMainMenu();submitbutton('new');" onclick=""> <img src="img/sweb/new_f2.png" alt="Nuevo" name="new" align="middle" border="0"> <br/> Nuevo</a> </td>
			<td>&nbsp;</td>
			<td><a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Por favor haga una selecci�n de la lista a eliminar'); } else if (confirm('�Esta seguro que desea eliminar los items seleccionados? ')){ submitbutton('remove');}" onClick=""> <img src="img/sweb/delete_f2.png" alt="Borrar" name="delete" align="middle" border="0"> <br/> Borrar</a> </td>
			<td>&nbsp;</td>
		<!-- end icons_toolbar.inc.htm -->
		</tr>
		<tr>
		</table>
	</td>
</tr>
</table>

<!-- end toolbar.inc.htm -->
<!-- start company.inc.htm -->

<div class="centermain" align="center">
	<div class="main">
	<!-- start form_users_list.inc.htm -->
		<table class="adminheading">
		<tr>
			<th class="categories"><img src="img/sweb/inventario.png" width="48" height="48" name="logo_Inventario" border="0" class="icon-png" alt="Inventario"/> Inventario <span id="filter"></span></th>
			<td class="msg">
<?php  
if (!isset($_GET['msg']))
	echo "&nbsp;";
else{
	if ($_GET['msg'] == 'success')
		echo "Operaci&oacute;n se realiz&oacute; con EXITO!";
	else
		echo "Ha ocurrido un error, por favor intente nuevamente.";
}
?>
			</td>
			<td>
				<form action="index.php?pages=inventario_list" method="post">
					<div style="text-align:right">
						<input class="inputbox" type="text" name="searchword" size="25" value="- Buscar -" onblur="if(this.value==&#39;&#39;) this.value=&#39;- Buscar -&#39;;" onfocus="if(this.value==&#39;- Buscar -&#39;) this.value=&#39;&#39;;">
            		<input type="hidden" name="option" value="search">
					</div>
				</form>
			</td>
		</tr>
		</table>

		<form action="index.php?pages=inventario_new" method="post" name="adminForm">
			<table class="adminlist">
			<tbody>
			<tr>
				<th align="center" width="5">&nbsp;  </th>
				<th width="20"> <input name="toggle" value="" onClick="checkAll(9);" type="checkbox"> </th>
				<th class="title"> <a href="javascript: listOrder('1');void(0);">Name</a> <img src="img/sweb//pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/> </th>
				<th align="left"> <a href="javascript: listOrder('2');void(0);">Grupo</a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/> </th>
				<th nowrap="nowrap" align="center" width="90"> <a href="javascript: listOrder('4');void(0);">Stock M&iacute;nimo</a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/> </th>
				<th nowrap="nowrap" align="center" width="90"> <a href="javascript: listOrder('5');void(0);">Stock Total</a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/> </th>
				<th nowrap="nowrap" align="center"> <a href="javascript: listOrder('6');void(0);">Valor unitario</a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/> </th>
				<th nowrap="nowrap" align="center"> <a href="javascript: listOrder('7');void(0);">Valor Caja</a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"> </th>
				<th nowrap="nowrap" align="center"> <a href="javascript: listOrder('7');void(0);">Valor Paquete</a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/> </th>		
				<th align="center"> <a href="javascript: listOrder('3');void(0);">Lote</a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/> </th>
				<th nowrap="nowrap" width="150" align="center">Imagen</th>
		
<?php 

$res = $db->query("SELECT id,link_type_item as titem,v_descr as name,link_marca as marca,stock_total,stock_min,price_unit,price_box,price_paq,image FROM ". TBL_ITEM);
$sw=0;
$cnt=1;

while($row = $db->getRow($res, 0)) {
	$qry = $db->query("SELECT di.id, dl.id as idlote FROM ". 
		TBL_ITEM ." di INNER JOIN ". TBL_LOT ." dl ON di.id=dl.id ".
		"WHERE dl.name='{$row['id']}'");
		
	$rwy = $db->getRow($qry, 0);	 

	if ($row['titem']=='Dvd-cd')
		$titem="multiple";
	else {
		if ($row['titem']=='Estuches')
			$titem="normal";
		else 
			$titem="stnd";
	}					 
?>
			</tr>
			<tr class="row<?php echo $sw;?>">
				<td align="center">&nbsp;</td>
				<td><input id="cb0" name="cid[]" value="60" onClick="isChecked(this.checked);" type="checkbox"/> </td>
				<td><a href="index.php?pages=modify&item=<?php echo $titem;?>&id=<?php echo $row['id'];?>"><?php echo $row['name'];?></a></td>
				<td align="left"><?php echo $row['titem'];?></td>
				<td align="center"><?php echo $row['stock_min'];?></td>
				<td align="center"><?php echo $row['stock_total'];?></td>
				<td align="center"><?php echo $row['price_unit'];?></td>
				<td align="center"><?php echo $row['price_paq'];?></td>
				<td align="center"><?php echo $row['price_box'];?></td>		
				<td align="center"><strong><a href="index.php?pages=lote_list&itemid=<?php echo $row['id']?>">Ver Lotes</a><br/><a href="index.php?pages=lote_new&itemid=<?php echo $row['id']?>">Nuevo Lote</a></strong></td>    
				<td align="center"><img src="<?php echo $row['image'];?>" height="50"></td>
			</tr>
<?php 
	if($sw=='1')
		$sw=0;
	else 
		$sw=1;
	
	$cnt++;        
} 
?>     	
			</tbody>
			</table>
			
			<table class="adminlist">
			<tr>
				<th colspan="3"><span class="pagenav">Paginas de Resultados: &nbsp;<b>1</b>&nbsp;</span></th>
			</tr>
			<tr>
				<td align="right" nowrap="true" width="48%">Mostrar #</td>
				<td>
					<select name="limit" class="inputbox" size="1" onChange="document.adminForm.submit();">
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="30" selected="">30</option>
					<option value="50">50</option>
					<option value="100">100</option>
					</select> 
				</td>
				<td align="left" nowrap="true" width="48%"> Lista de Resultados </td>
			</tr>
			</table>
  
			<input name="option" value="inventario" type="hidden">
			<input name="section" value="" type="hidden">
			<input name="task" value="new" type="hidden">
			<input name="chosen" value="" type="hidden">
			<input name="act" value="" type="hidden">
			<input name="boxchecked" value="0" type="hidden">
			<input name="type" value="list" type="hidden">
			<input name="hidemainmenu" value="1" type="hidden">
			<input name="order" type="hidden" id="order" value="{FORM_ORDER_BY}">
			<input name="flag_order" type="hidden" id="flag_order" value="0">
		</form>
		<!-- end form_users_list.inc.htm -->
	</div>
</div>
<!-- end company.inc.htm -->
