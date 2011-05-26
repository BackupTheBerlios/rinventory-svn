<p class="form-title">Detalle de Lote</p>
<?php
if (!Forms::checkPermission(FORM_LOT_EDIT))
	return;
	
require_once 'inc/class.item.php';
require_once 'inc/class.store.php';
require_once 'inc/class.lot.php';
require_once 'inc/class.formatter.php';

$lot = new Lot();
$item = new Item();
$store = new Store();
$lotid = isset($_GET['lot']) && is_numeric($_GET['lot'])? $_GET['lot'] : 0;

if ($lot->read($lotid)){
	$item->read($lot->itemid);
	$store->read($lot->storeid);
}

include 'inc/widget/error.php';
?>
<form method="post">
	<table class="form">
	<tr>
		<td class="label">Lote Nro.:</td>
		<td><?php echo $lot->id;?></td>
	</tr>
	<tr>
		<td class="label">Producto:</td>
		<td><?php echo "$item->name, $item->type</span>";?></td>
	</tr>
	<tr>
		<td class="label">Cajas:</td>
		<td><?php echo $lot->boxes;?></td>
	</tr>
	<tr>
		<td class="label">Unidades:</td>
		<td><?php echo $lot->units;?></td>
	</tr>
	<tr>
		<td class="label">Stock:</td>
		<td class="number"><?php echo $lot->stock;?></td>
	</tr>
	<tr>
		<td class="label">Activo:</td>
		<td><input type="checkbox" value="1"<?php echo $lot->active == 1 ? " checked='checked'" : "";?>/></td>
	</tr>
	<tr>
		<td class="label">Almacen</td>
		<td><?php echo $store->name;?></td>
	</tr>
	<tr>
		<td class="label">Costo:</td>
		<td><input name="costo" onchange="sumar()" type="text" id="costo" value="<?php echo $lot->cost;?>" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Transporte Maritimo:</td>
		<td><input name="tmar" onchange="sumar()" type="text" id="tmar" value="<?php echo $lot->costMar;?>" size="30"/></td>
	</tr>            
	<tr>
		<td class="label">Transporte Terrestre:</td>
		<td><input name="tter" onchange="sumar()" type="text" id="tter" value="<?php echo $lot->costTer;?>" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Aduana:</td>
		<td><input name="aduana" onchange="sumar()" type="text" id="aduana" value="<?php echo $lot->costAdu;?>" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Transferencia Bancaria:</td>
		<td><input name="tbank" onchange="sumar()" type="text" id="tbank" value="<?php echo $lot->costBank;?>" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Carguio / Desacargio:</td>
		<td><input name="cade" onchange="sumar()" type="text" id="cade" value="<?php echo $lot->costLoad;?>" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Otros:</td>
		<td><input name="other" onchange="sumar()" type="text" id="other" value="<?php echo $lot->costOther;?>" size="30"/></td>
	</tr>
	<tr>
		<td class="label">Precio Final:</td>
		<td colspan="2"><input style="background-color:#DFDFDF" name="pricef" type="text" readonly="readonly" id="pricef" value="<?php echo $lot->price;?>" size="20">  ( Precio final de compra) </td>
	</tr>
	<tr>
		<td class="label">Observaciones:</td>
		<td><textarea name="notes" cols="45" rows="7" id="Description"></textarea></td>
	</tr>
	</table>
	<input type="hidden" name="pages" value="<?php echo FORM_LOT_EDIT;?>"/>
	<input type="hidden" name="lotid" value="<?php echo $lotid;?>"/>
	<br />
	<button id="save">Guardar</button>
</form>

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
