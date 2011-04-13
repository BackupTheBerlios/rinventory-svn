<style>
.st_tbcss,.st_tdcss,.st_divcss,.st_ftcss{border:none;padding:0px;margin:0px}
A.st_acss,A.st_acss:link,A.st_acss:visited,A.st_acss:active,A.st_acss:hover{background-color:transparent;font-style:normal;border:none}
</style>
<!-- end top_menu.inc.htm -->
<!-- start toolbar.inc.htm -->

<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td class="menudottedline" width="40%"><div class="pathway"><a href="index.php" class="headerNavigation">Panel de Control</a> <?php echo SB_BREADCRUMB;?> <a href="index.php?pages=lote_list" class="headerNavigation">Lotes</a></div></td>
	<td class="menudottedline" align="right">
		<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
		<tr align="center" valign="middle">
		<!-- start icons_toolbar_edit.inc.htm -->
		<td><a class="toolbar" href="javascript:beforeSaving()" onClick=""> <img src="img/sweb/save_f2.png" alt="Activo" name="active" align="middle" border="0"> <br> Guardar</a> </td>
		<td>&nbsp;</td>
		<td><a class="toolbar" href="javascript:showMainMenu();cancelar('lote_list');" onClick=""> <img src="img/sweb/cancel_f2.png" alt="Nuevo" name="new" align="middle" border="0"> <br> Cancelar</a> </td>
		<td>&nbsp;</td>
		</tr>
		</table>
	</td>
</tr>
</table>


<!-- end toolbar.inc.htm -->
<!-- start company.inc.htm -->
<script type="text/javascript">
jQuery(document).ready(function(){
	setupInputInteger('box');
	setupInputInteger('units');
	setupInputDecimal('costo');
	setupInputDecimal('tmar');
	setupInputDecimal('tter');
	setupInputDecimal('aduana');
	setupInputDecimal('tbank');
	setupInputDecimal('cade');
	setupInputDecimal('other');
});

function beforeSaving(){
		if(jQuery('#items').val()=='')
			alert('Por favor elija el producto'); 
		else if (jQuery('#box').val()=='')
			alert('Por favor Ingrese la cantidad de cajas');
		else if (jQuery('#units').val()=='')
			alert('Ingrese el N&uacute;mero de unidades');
		else
			submitbutton('save');
}

function multiplicar(){
	var m1 = jQuery("#box").val();
	var m2 = jQuery("#units").val();
	var r = m1*m2;
	var pf = jQuery("#pricef").val();
	 
	jQuery("#stock").val(r);
	
	if ((pf !='')||(pf>='0'))
		sumar();
}

function sumar(){
	var res = parseFloat(jQuery('#costo').val())+
			parseFloat(jQuery('#tmar').val())+
			parseFloat(jQuery('#tter').val())+
			parseFloat(jQuery('#cade').val())+
			parseFloat(jQuery('#other').val())+
			parseFloat(jQuery('#aduana').val())+
			parseFloat(jQuery('#tbank').val());
	var d1 = parseInt(jQuery('#stock').val());
	var r = (res / d1);

	jQuery("#pricef").val(r);
}

function cancelar(module)
{
    document.location='index.php?pages='+module;
}
</script>
<div class="centermain" align="center">
	<div class="main">
	<!-- start form_departamentos_edit.inc.htm -->
		<table class="adminheading">
		<tr>
			<th class="categories"><img src="img/sweb/almacenes.png" width="48" height="48" name="logo_Departamentos" border="0" class="icon-png" alt="Departamentos">Lotes</th>
		</tr>
		</table>

		<form action="index.php?pages=lote" method="post" name="adminForm" enctype="multipart/form-data">
			<table class="adminform">
			<!--DWLayoutTable-->
			<tr>
				<th colspan="3">Detalles</th>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Nombre:</div></td>
				<td>
<?php
if (isset($_GET['itemid'])){
	$res = $db->query("SELECT link_type_item as name,v_descr FROM ".TBL_ITEM." WHERE id={$_GET['itemid']}");
	$row = $db->getRow($res, 0);
	echo "<input type='hidden' name='items' value='{$_GET['itemid']}'/><span>{$row['name']}, {$row['v_descr']}</span>";
}
else{
?>
					<select name="items" id="items" style="width:250px;" class="text_area">
					<option value=""></option>
<?php
	$res = $db->query("SELECT id,link_type_item as name,v_descr FROM ".TBL_ITEM);

	while($row = $db->getRow($res,0)) 
?>
					<option value="<?php echo $row['id'];?>"> <?php echo $row['name'].', '.$row['v_descr']; ?></option>
<?php  	
}
?>
				</td>
				<td rowspan="9" valign="top"></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Cajas:</div></td>
				<td><input name="box" type="text" class="text_area" onchange="multiplicar()" id="box" value="" size="20"> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Unidades:</div></td>
				<td><input name="units" type="text" onchange="multiplicar()" class="text_area" id="units" value=""  size="20"> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td width="250" nowrap="nowrap"><div align="right">Stock:</div></td>
				<td><input name="stock" type="text"  class="text_area" readonly="readonly" id="stock" value="0" size="20"></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Activo:</div></td>
				<td><input name="active" type="checkbox" id="active" value="1"></td>
			</tr>
			<tr>
				<td width="250" nowrap="nowrap"><div align="right">Almacen</div></td>
				<td>
					<select name="almacen" id="almacen" style="width:250px;" class="text_area">
					<option value=""></option>
<?php
$res = $db->query("SELECT id,name FROM ".TBL_DEPARTMENT);

while($row = $db->getRow($res,0)) {
?> 
					<option value="<?php echo $row['id'];?>"> <?php echo $row['name']; ?></option>
<?php
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Costo:</div></td>
				<td><input name="costo" onchange="sumar()" type="text" class="text_area" id="costo" value="0" size="30"/></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Transporte Maritimo:</div></td>
				<td><input name="tmar" onchange="sumar()" type="text" class="text_area" id="tmar" value="0" size="30"/></td>
			</tr>            
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Transporte Terrestre :</div></td>
				<td><input name="tter" onchange="sumar()" type="text" class="text_area" id="tter" value="0" size="30"/></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Aduana :</div></td>
				<td><input name="aduana" onchange="sumar()" type="text" class="text_area" id="aduana" value="0" size="30"/></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Transferencia Bancaria :</div></td>
				<td><input name="tbank" onchange="sumar()" type="text" class="text_area" id="tbank" value="0" size="30"/></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Carguio / Desacargio :</div></td>
				<td><input name="cade" onchange="sumar()" type="text" class="text_area" id="cade" value="0" size="30"/></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Otros:</div></td>
				<td><input name="other" onchange="sumar()" type="text" class="text_area" id="other" value="0" size="30"/></td>
			</tr>
			<tr>
				<td width="250" nowrap="nowrap"><div align="right">Precio Final:</div></td>
				<td colspan="2"><input style="background-color:#DFDFDF" name="pricef" type="text" readonly="readonly" class="text_area" id="pricef" value="" size="20">  ( Precio final de compra) </td>
			</tr>
			<tr>
				<td width="250" rowspan="2" valign="top" nowrap="nowrap"><div align="right">Observaciones: </div></td>
				<td width="445" height="1"></td>
				<td></td>
			</tr>
			<tr>
				<td valign="top"><div class="htmlarea"><textarea name="notes" cols="45" rows="7" class="text_area" id="Description"></textarea></div></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3"><br>
					<input name="option" value="com_departamentos" type="hidden"/>
					<input name="section" value="" type="hidden"/>
					<input name="task" value="" type="hidden"/>
					<input name="id" type="hidden" id="id" value=""/>
					<input name="dirPath" type="hidden" id="dirPath" value=""/>
					<input name="hidemainmenu" value="0" type="hidden"/>
				</td>
			</tr>
			</table>
		</form>
		<!-- end form_departamentos_edit.inc.htm -->
	</div>
</div>
