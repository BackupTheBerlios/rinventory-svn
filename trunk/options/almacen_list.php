<style>
.st_tbcss,.st_tdcss,.st_divcss,.st_ftcss{border:none;padding:0px;margin:0px}
A.st_acss,A.st_acss:link,A.st_acss:visited,A.st_acss:active,A.st_acss:hover{background-color:transparent;font-style:normal;border:none}
</style>
<!-- end top_menu.inc.htm -->
<!-- start toolbar.inc.htm -->

<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td class="menudottedline" width="40%"><div class="pathway"><a href="index.php?option=home" class="headerNavigation">Panel de Control</a> <?php echo SB_BREADCRUMB;?> <a href="index.php?pages=almacen_list" class="headerNavigation">Almacen</a></div></td>
	<td class="menudottedline" align="right">
		<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
		<tbody>
		<tr align="center" valign="middle">
			<!-- start icons_toolbar.inc.htm -->
			<td><a class="toolbar" href="javascript:submitbutton('new');" onClick=""> <img src="img/sweb/new_f2.png" alt="Nuevo" name="new" align="middle" border="0"> <br>Nuevo</a> </td>    
			<td>&nbsp;</td>
			<td><a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Por favor haga una selección de la lista a eliminar'); } else if (confirm('¿Esta seguro que desea eliminar los items seleccionados? ')){ submitbutton('remove');}" onClick=""> <img src="img/sweb/delete_f2.png" alt="Borrar" name="delete" align="middle" border="0"> <br>Borrar</a> </td>
			<td>&nbsp;</td>
			<!-- end icons_toolbar.inc.htm -->
		</tr>
		</tbody>
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
		<tr>
			<th class="categories"><img src="img/sweb/departamentos.png" width="48" height="48" name="logo_Departamentos" border="0" class="icon-png" alt="Departamentos"> Almacen <span id="filter"></span></th>
		</tr>
		</table>

		<form action="index.php?option=almacen_new" method="post" name="adminForm">
			<table class="adminlist">
			<tbody>
			<tr>
				<th align="center" width="25"> <a href="javascript: listOrder('0');void(0);"><img src="img/sweb//pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"> </a> </th>
				<th width="20"> <input name="toggle" value="" onClick="checkAll(2);" type="checkbox"> </th>
				<th class="title"> <a href="javascript: listOrder('1');void(0);">Nombre </a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"> </th>
				<th width="70"> <a href="javascript: listOrder('2');void(0);">Activo </a> <img src="img/sweb/sort_asc.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"> </th>
				<th align="left"> <a href="javascript: listOrder('3');void(0);">Nombre de Contacto </a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"> </th>
				<th align="left"> <a href="javascript: listOrder('4');void(0);">E-Mail </a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"> </th>
				<th nowrap="nowrap"> <a href="javascript: listOrder('5');void(0);">Tel&eacute;fono </a> <img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"> </th>
				<th> Productos </th>
<?php
$res = $db->query("Select id,name,active,contact_name,email,phone from dvd_departament");
$sw=0; $cnt=1;

while($row = $db->getRow($res, 0)){
	$sim="tick.png";
	
	if($row['active']==0)
		$sim="publish_x.png";  
?>
			</tr>
			<tr class="row<?php echo $sw;?>">
				<td align="center"> <?php echo $cnt; ?> </td>
				<td><input id="cb0" name="cid[]" value="15" onClick="isChecked(this.checked);" type="checkbox"> </td>
				<td><a href="index.php?pages=modify_alm&id=<?php echo $row['id'];?>"><?php echo $row['name'];?></a></td>
				<td align="center"><a href="javascript: void(0);" onClick="return listItemTask(&#39;cb0&#39;,&#39;inactive&#39;)" title="Activo"><img src="img/sweb/<?php echo $sim;?>" alt="Activo" border="0"></a> </td>
				<td align="left"><?php echo $row['contact_name'];?></td>
				<td align="left"><?php echo $row['email'];?></td>
				<td align="center"><?php echo $row['phone'];?></td>
				<td align="center"><a href="index.php?pages=detalle_alm&id=<?php echo $row['id'];?>">Detalles...</a></td>
			</tr>
<?php 
	$sw = $sw==1 ? 0 : 1;
	$cnt++;        
} 
?>     	  
			</tbody>
			</table>
			
			<table class="adminlist">
			<tbody>
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
			</tbody>
			</table>
  
			<input name="option" value="com_departamentos" type="hidden">
			<input name="section" value="" type="hidden">
			<input name="task" value="" type="hidden">  
			<input name="module" value="almacen" id="module" type="hidden">
			<input name="act" value="" type="hidden">
			<input name="boxchecked" value="0" type="hidden">
			<input name="type" value="list" type="hidden">
			<input name="order" type="hidden" id="order" value="{FORM_ORDER_BY}">
			<input name="flag_order" type="hidden" id="flag_order" value="0">
		</form>
		<!-- end form_departamentos_list.inc.htm -->
	</div>
</div>
