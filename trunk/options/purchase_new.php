<p class="form-title">Registro de nueva compra</p><?phpinclude 'inc/widget/error.php'; ?><form method="POST" name="form1" action="">	<input type="hidden" value="purchase_new" name="page"/> 	<table class="form">	<tr>
		<td class="label">C&oacute;digo:</td>
		<td><input type="text" size="16" name="code" /> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Fecha:</td>
		<td><input type="text" size="16" name="date" id="date" /> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Anticipo:</td>
		<td><input type="text" size="16" name="prepayment" value="0"/><?php echo SB_CURRENCY;?></td>
	</tr>
	<tr>
		<td class="label">Proveedor:</td>
		<td><input type="text" size="30" name="provider" /> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Observaciones:</td>
		<td><textarea name="gloss" rows="3" cols="30"></textarea></td>	</tr>
	</table>
	<table>
	<tr>
		<td>
			<div class="ui-widget-header ui-corner-all toolbar-small">
				<button onclick="addRow();return false;" id="add_row" class="button">A&ntilde;adir Fila</button>
				<button onclick="removeRow();return false;" id="remove_row" class="button">Eliminar Filas Seleccionadas</button>
				<span style="margin-left:2em">Detalle de compra</span>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div>
				<table id="detail" class="default">
				<thead>
				<tr>
					<th>&nbsp;</th>
					<th style="width:2em">#</th>
					<th>Descripci&oacute;n</th>
					<th>Precio <?php echo SB_CURRENCY;?></th>
					<th>Cantidad</th>
					<th style="width:6em">Total <?php echo SB_CURRENCY;?></th>
				</tr>
				</thead>
				<tbody>	
				</tbody>
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
	</table>	<br />
	<button id="save">Guardar</button>
</form>
<div id="dialog">
Usted esta a punto de registrar una compra.<br/>
&iquest;Est&aacute; seguro de realizar esta compra?
</div>
<div id="dialog_error"><div class="error-list"></div></div>
<script type="text/javascript">
jQuery(document).ready(function(){
	setupInputDecimalByObj(jQuery('input[name="prepayment"]'));
	jQuery('#date').datepicker();
	jQuery('#add_row').button();
	jQuery('#remove_row').button();
	jQuery('#save').button({		icons:{primary: 'ui-icon-disk'}	}).click(function(){
		var error = checkData();		if (!error)
			jQuery('#dialog').dialog('open');
		else{
			jQuery('#dialog_error .error-list').html('<span class="ui-icon ui-icon-alert"></span>'+error);
			jQuery('#dialog_error').dialog('open');
		}		
		return false;
	});
	jQuery('#dialog').dialog({
		modal: true,
		autoOpen: false,		title: '<?php echo ALERT_TITLE;?>',
		buttons: {
			'Aceptar': function(){
				document.forms['form1'].submit();
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
	addRow();
});
function addRow(){
	var tbody = jQuery('#detail tbody').append('<tr><td><input type="checkbox"/></td>'+
			'<td class="row-counter number"></td>'+
			'<td><input type="textbox" name="description[]" size="50"/></td>'+
			'<td class="number"><input type="textbox" name="price[]" value="0"/></td>'+
			'<td class="number"><input type="textbox" name="quantity[]" value="1"/></td>'+
			'<td class="number line-total">&nbsp;</td></tr>');
	var lastTr = tbody.children('tr:last');
	var priceObj = lastTr.find('input[name^="price"]');
	var qtyObj = lastTr.find('input[name^="quantity"]');
	setupInputDecimalByObj(lastTr.find('input[name^="price"]'));
	setupInputIntegerByObj(lastTr.find('input[name^="quantity"]'));
	priceObj.blur(function(){		calcTotal();
	});
	qtyObj.blur(function(){
		calcTotal();
	});
	refresh();
}
function removeRow(){
	jQuery('#detail tbody input:checked').each(function(){
		jQuery(this).closest('tr').remove();
	});
	refresh();
}
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
	totals.each(function(index){		var totalLine = Number(prices[index].value)*Number(qties[index].value); 		this.innerHTML = totalLine.toFixed(2);		total += totalLine;	});	jQuery('#detail tfoot .total').text(total.toFixed(2));
}
function checkData(){
	var error = '';
	if(!jQuery('input[name="code"]').val())
		error += '<li>Debe ingresar un c&oacute;digo de compra.</li>';
	if(!jQuery('input[name="date"]').val())		error += '<li>Debe ingresar la fecha de compra.</li>';
	if(!jQuery('input[name="provider"]').val())		error += '<li>Debe ingresar el proveedor de la compra.</li>';
	if (Number(jQuery('#detail tfoot .total').text()) <= 0)		error += '<li>Detalle de compra incorrecto.</li>';	if (Number(jQuery('#detail tfoot .total').text()) < Number(jQuery('input[name="prepayment"]').val()))		error += '<li>Anticipo no debe exceder monto total de compra.</li>';		
	if (error)		error = '<ul>' + error + '</ul>';	return error;}
</script>