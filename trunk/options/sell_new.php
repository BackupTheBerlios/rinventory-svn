<p class="form-title">Registro de Venta</p>
<?php
require_once 'inc/class.session.php';
require_once 'inc/class.store.php';
require_once 'inc/class.item.php';

$session = Session::getInstance();
$stores = Store::getAllActive("name", "ASC");
$storeid = isset($_GET['store']) ? $_GET['store'] : ""; 
$items = is_numeric($storeid) ? Item::getAllFromStore($storeid) : array();

include 'inc/widget/error.php'; 
?>
<form action="" method="GET" name="form1">
<table class="form">
<tr>
	<td class="label"  style="width:9em">Almacen:</td>
	<td>
		<input type="hidden" name="pages" value="sell_new"/>
		<select id="store_selector" name="store">
		<option value="">-Seleccionar Almacen-</option>
		<?php
		foreach($stores as $store){
			echo "<option value='$store->id'".($store->id==$storeid ? " selected='selected'" : "").">$store->name</option>";
		}
		?>
		</select> 
		<span class="mandatory">*</span>
	</td>
</tr>
</table>
</form>

<form action="" method="POST" name="form2">
	<table class="form">
	<tr>
		<td class="label" style="width:9em">Fecha:</td>
		<td><input name="date" type="text" id="fecha" value="" size="16"> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Cliente:</td>
		<td><input name="customer" type="text" id="cliente" value="" size="30"/> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">NIT Cliente:</td>
		<td><input name="nit" type="text" id="nit" value="" size="16"></td>
	</tr>
	<tr>
		<td class="label">Forma de Pago:</td>
		<td>
			<label for="payment_cash">Contado</label> <input type="radio" value="<?php echo PAYMENT_TYPE_CASH;?>" name="payment_type" id="payment_cash" checked="checked"/> &nbsp;
			<label for="payment_credit">Credito</label> <input type="radio" value="<?php echo PAYMENT_TYPE_CREDIT;?>" name="payment_type"  id="payment_credit"/>
		</td>
	</tr>
	<tr id="row_prepayment" style="display:none">
		<td class="label">Anticipo:</td>
		<td><input type="text" size="16" name="prepayment" value="0"/> <?php echo SB_CURRENCY;?></td>
	</tr>
	</table>
	<br/>
	<table>
	<tr>
		<td>
			<div class="ui-widget-header ui-corner-all toolbar-small">
				Items disponibles:
				<select id="items_selector">
				<option value="">- Seleccione Item -</option>
				</select>
				<button id="button_add" class="button">A&ntilde;adir</button>
				<button id="remove_row" class="button">Eliminar Filas Seleccionadas</button>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div>
				<table class="default" id="detail">
				<thead>	
				<tr>
					<td>&nbsp;</td>
					<th>#</th>
					<th style="width:30em">Descripci&oacute;n</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th style="width:9em">Total</th>
				</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<td colspan="5">&nbsp;</td>
						<td class="total number">&nbsp;</td>
					</tr>
				</tfoot>
				</table>
			</div>
		</td>
	</tr>
	</table>
	<input type="hidden" name="page" value="sell_new"/>	
	<input type="hidden" name="store" value="<?php echo $storeid;?>"/>
	<br />
	<button id="save">Guardar</button>
</form>
<input type="hidden" value="<?php echo htmlentities(json_encode($items));?>" id="items_data"/>

<div id="dialog">
<p>Usted esta a punto de registrar una venta, esta operaci&oacute;n es irreversible.</p>
<p>&iquest;Est&aacute; seguro de realizar esta compra?</p>
</div>

<div id="dialog_error"><div class="error-list"></div></div>

<script type="text/javascript">
var ITEMS = false;

jQuery(document).ready(function(){
	jQuery('#fecha').datepicker();
	fillItems();

	jQuery('#button_add').button().click(function(){
		var i = jQuery('#items_selector').val();

		if (!i)
			return false;
		
		var tbody = jQuery('#detail tbody').append('<tr>'+
				'<td><input type="checkbox" value="'+i+'"/>'+
				'<td class="row-counter">&nbsp;</td>'+
				'<td><input type="hidden" name="lot[]" value="' + ITEMS[i]['lotid'] + '"/>' + ITEMS[i]['name'] + '</td>' +
				'<td class="number">'+
					'<select><option value="price_unit">Unidad</option><option value="price_pack">Paquete</option><option value="price_box">Caja</option></select>'+
					'<input type="text" name="price[]" size="9" value="' + ITEMS[i]['price_unit'] + '"/>'+
				'</td>'+
				'<td class="number"><input type="text" value="0" name="quantity[]" size="9"/></td>'+
				'<td class="number line-total">&nbsp</td>'+
				'</tr>');

		refresh();

		var lastTr = tbody.children('tr:last');
		var priceObj = lastTr.find('input[name^="price"]');
		var qtyObj = lastTr.find('input[name^="quantity"]');

		setupInputDecimalByObj(lastTr.find('input[name^="price"]'));
		setupInputIntegerByObj(lastTr.find('input[name^="quantity"]'));

		lastTr.find('select').change(function(){
			lastTr.find('input[name^="price"]').val(ITEMS[i][this.value]);
			calcTotal();
		});
		
		priceObj.blur(function(){
			calcTotal();
		});

		qtyObj.blur(function(){
			calcTotal();
		});
		
		return false;
	});

	jQuery('#remove_row').button().click(function(){
		jQuery('#detail tbody input:checked').each(function(){
			jQuery(this).closest('tr').remove();
		});

		refresh();
		
		return false;
	});
	
	jQuery('#save').button({
		icons:{primary: 'ui-icon-disk'}
	}).click(function(){
		var error = checkData();

		if (!error)
			jQuery('#dialog').dialog('open');
		else{
			jQuery('#dialog_error .error-list').html('<?php echo ICON_ALERT;?>'+error);
			jQuery('#dialog_error').dialog('open');
		}		

		return false;
	});

	jQuery('input[name="payment_type"]').click(function(){
		jQuery('#row_prepayment').css('display', this.value==<?php echo PAYMENT_TYPE_CASH;?> ? 'none' : '');
	});
	
	jQuery('#store_selector').change(function(){
		document.forms['form1'].submit();		
	});

	jQuery('#dialog').dialog({
		modal: true,
		autoOpen: false,
		title: '<?php echo ALERT_TITLE;?>',
		buttons: {
			'Aceptar': function(){
				document.forms['form2'].submit();
			},
			'Cancelar': function(){
				jQuery(this).dialog('close');
			}
		}
	});

	jQuery('#dialog_error').dialog({
		modal: true,
		autoOpen: false,
		title: '<?php echo ERROR_TITLE;?>',
		buttons: {
			'Aceptar': function(){jQuery(this).dialog('close');}
		}
	});
});

function refresh(){
	jQuery('#detail td.row-counter').each(function(index){
		this.innerHTML = Number(index)+1;
	});

	jQuery('#detail tbody tr:odd').addClass('alternate');
	jQuery('#detail tbody tr:even').removeClass('alternate');
	calcTotal();
}

function calcTotal(){
	var prices = jQuery('#detail tbody input[name^="price"]');
	var qties = jQuery('#detail tbody input[name^="quantity"]');
	var totals = jQuery('#detail tbody .line-total');
	var total = 0;

	totals.each(function(index){
		var totalLine = Number(prices[index].value)*Number(qties[index].value); 

		this.innerHTML = totalLine.toFixed(2);
		total += totalLine;
	});

	jQuery('#detail tfoot .total').text(total.toFixed(2));
}
function fillItems(){
	var select = jQuery('#items_selector');
	
	ITEMS = JSON.parse(jQuery('#items_data').val());
	
	for(var i in ITEMS){
		select.append('<option value="' + i +'">' + ITEMS[i]['name'] + '</option>');	
	}
}
function addItem(){
	var itemData = JSON.parse(jQuery('#item_selector').val());
	var tableItems = jQuery('#table_items');
	alert(tableItems.find('tbody').length);
	tableItems.find('tbody').append('<tr><td></td>'+
			'<td>'+itemData.name+'</td>'+
			'<td><input type="text" value="" class="decimal"/></td></tr>');
}
function checkData(){
	var error = '';

	if (!jQuery('input[name="store"]').val())
		error += '<li>Debe seleccionar Almacen.</li>';
	 
	if (!jQuery('input[name="date"]').val())
		error += '<li>Debe introducir Fecha.</li>';

	if (!jQuery('input[name="customer"]').val())
		error += '<li>Debe introducir Cliente.</li>';

	if (error)
		error = '<ul>' + error + '</ul>';
		
	return error;
}
</script>