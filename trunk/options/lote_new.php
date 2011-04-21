<?php
require_once 'inc/class.mysqli.php';

$db = Database::getInstance(); 
?>
<p class="form-title">Registro de Nuevo Lote</p>
<form action="index.php?pages=lote" method="post" name="adminForm" enctype="multipart/form-data">
	<table class="form">
	<tr>
		<td class="label">Nombre:</td>
		<td>
<?php
if (isset($_GET['itemid'])){
	$res = $db->query("SELECT link_type_item as name,v_descr FROM ".TBL_ITEM." WHERE id={$_GET['itemid']}");
	$row = $db->getRow($res, 0);
	echo "<input type='hidden' name='items' value='{$_GET['itemid']}'/><span>{$row['name']}, {$row['v_descr']}</span>";
}
else{
?>
			<select name="items" id="items">
			<option value=""></option>
<?php
	$res = $db->query("SELECT id,link_type_item as name,v_descr FROM ".TBL_ITEM);

	while($row = $db->getRow($res,0)) 
?>
			<option value="<?php echo $row['id'];?>"> <?php echo $row['name'].', '.$row['v_descr']; ?></option>
<?php  	
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label">Cajas:</td>
		<td><input name="box" type="text" onchange="multiplicar()" id="box" value="" size="20"> <span class="mandatory">*</span> </td>
	</tr>
	<tr>
		<td class="label">Unidades:</td>
		<td><input name="units" type="text" onchange="multiplicar()" id="units" value=""  size="20"> <span class="mandatory">*</span> </td>
	</tr>
	<tr>
		<td class="label">Stock:</td>
		<td><input name="stock" type="text" readonly="readonly" id="stock" value="0" size="20"></td>
	</tr>
	<tr>
		<td class="label">Activo:</td>
		<td><input name="active" type="checkbox" id="active" value="1"></td>
	</tr>
	<tr>
		<td class="label">Almacen</td>
		<td>
			<select name="almacen" id="almacen">
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
		<td class="label">Costo:</td>
		<td><input name="costo" onchange="sumar()" type="text" id="costo" value="0" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Transporte Maritimo:</td>
		<td><input name="tmar" onchange="sumar()" type="text" id="tmar" value="0" size="30"/></td>
	</tr>            
	<tr>
		<td class="label">Transporte Terrestre:</td>
		<td><input name="tter" onchange="sumar()" type="text" id="tter" value="0" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Aduana:</td>
		<td><input name="aduana" onchange="sumar()" type="text" id="aduana" value="0" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Transferencia Bancaria:</td>
		<td><input name="tbank" onchange="sumar()" type="text" id="tbank" value="0" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Carguio / Desacargio:</td>
		<td><input name="cade" onchange="sumar()" type="text" id="cade" value="0" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Otros:</td>
		<td><input name="other" onchange="sumar()" type="text" id="other" value="0" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Precio Final:</td>
		<td colspan="2"><input style="background-color:#DFDFDF" name="pricef" type="text" readonly="readonly" id="pricef" value="" size="20">  ( Precio final de compra) </td>
	</tr>
	<tr>
		<td class="label">Observaciones:</td>
		<td><textarea name="notes" cols="45" rows="7" id="Description"></textarea></td>
	</tr>
	</table>
	<br />
	<button id="save">Guardar</button>
</form>
<div id="dialog_error"><div class="error-list"></div></div>
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

	jQuery('#save').button({
		icons:{primary: 'ui-icon-disk'}
	}).click(function(){
		var error = checkData(); 

		if (error){
			jQuery('#dialog_error .error-list').html('<span class="ui-icon ui-icon-alert"></span>' + error);
			jQuery('#dialog_error').dialog('open');
			return false;
		}
	});
	jQuery('#dialog_error').dialog({
		autoOpen: false,
		modal: true,
		title: 'Se detectaron Errores!',
		buttons: {
			'Aceptar': function(){jQuery(this).dialog("close")}
		}
	});
});

function checkData(){
	var error = '';

	//if(!jQuery('#items').val())
	//	error += '<li>Por favor elija el producto</li>'; 

	if (!jQuery('#box').val())
		error += '<li>Por favor Ingrese la cantidad de cajas</li>';

	if (!jQuery('#units').val())
		error += '<li>Ingrese el N&uacute;mero de unidades</li>';

	if (error)
		error = '<ul>' + error + '<ul>';

	return error;
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
</script>