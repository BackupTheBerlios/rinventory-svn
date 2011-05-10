<p class="form-title">Venta</p>
<?php
if(!Forms::checkPermission(FORM_SELL_EDIT))
	return;
	
require 'inc/class.sell.php';
require 'inc/class.formatter.php';

$sellid = isset($_GET['sell']) && is_numeric($_GET['sell']) ? $_GET['sell'] : false; 
$log = Log::getInstance();
$isValid = true; 

if (!$sellid){
	$log->addError("No existen datos de Venta solicitada.");
	$isValid = false;
}

$sell = new Sell();

if(!$sell->read($sellid)){
	$log->addError("No existen datos de Venta solicitada.");
	$isValid = false;	
}

$details = SellDetail::getAll($sellid);
$payments = SellPayment::getAll($sellid);

include 'inc/widget/error.php';

if (isset($_POST['page']) && isset($_POST['sell']) && !$log->isError()){
	include 'inc/widget/success.php';
}

if($isValid){
?>
<form action="" method="POST" name="form1">
	<table class="form">
	<tr>
		<td class="label">Venta Nro.:</td>
		<td><?php echo $sell->id;?></td>
	</tr>
	<tr>
		<td class="label">Estado</td>
		<td>
			<select name="status">
			<?php
			foreach($PURCHASE_STATUS as $key => $label){
				echo "<option value='$key'".($key==$sell->status ? " selected='selected'" : "").">$label</option>";
			}	 
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label">Fecha:</td>
		<td><?php echo $sell->date;?></td>
	</tr>
	<tr>
		<td class="label">Forma de Pago:</td>
		<td><?php echo $PAYMENT_TYPE[$sell->paymentType];?></td>
	</tr>
	<?php if ($sell->paymentType == PAYMENT_TYPE_CREDIT){?>
	<tr>
		<td class="label">Anticipo:</td>
		<td><?php echo Formatter::currency($sell->prepayment);?></td>
	</tr>
	<?php } ?>
	<tr>
		<td class="label">Cliente:</td>
		<td><?php echo $sell->customer; ?></td>
	</tr>
	<tr>
		<td class="label">NIT de Cliente:</td>
		<td style="width:15em"><?php echo $sell->nit;?></td>
	</tr>
	</table>
	<p class="form-subtitle">Detalle de Venta</p>
	<table id="detail" class="default">
	<thead>
		<tr>
			<th style="width:2em">#</th>
			<th style="width:35em">Descripci&oacute;n</th>
			<th style="width:8em">Precio <?php echo SB_CURRENCY;?></th>
			<th style="width:8em">Cantidad</th>
			<th style="width:8em">Total <?php echo SB_CURRENCY;?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$total = 0;
	
	foreach ($details as $detail){
		$total += $detail->price*$detail->quantity;
		echo "<tr><td class='number'>$detail->line</td>".
			"<td>$detail->description</td>".
			"<td class='number price'>".Formatter::number($detail->price)."</td>".
			"<td class='number quantity'>$detail->quantity</td>".
			"<td class='number line-total'>".Formatter::number($detail->price*$detail->quantity)."</td></tr>";
	} 
	?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4">&nbsp;</td>
			<td class="total number"><?php echo Formatter::number($total)?></td>
		</tr>
	</tfoot>
	</table>
	<p class="form-subtitle">Detalle de Pagos</p>
	<table class="default">
	<thead>
	<tr>
		<th style="width:2em">#</th>
		<th style="width:8em">Fecha</th>
		<th style="width:30em">Aceptado por</th>
		<th style="width:8em">Monto <?php echo SB_CURRENCY;?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	$totalPaid = 0;
	foreach($payments as $payment){
		echo "<tr>";
		echo "<td class='number'>$payment->line</td>";
		echo "<td class='date'>".Formatter::date($payment->date)."</td>";
		echo "<td>$payment->createdBy</td>";
		echo "<td class='number'>".Formatter::number($payment->amount)."</td>";
		echo "</tr>";
		$totalPaid += $payment->amount;
	} 
	$outstanding = $total-$totalPaid;
	?>
	</tbody>
	<tfoot>
	<tr>
		<td colspan="3" style="text-align:right">Total: </td>
		<td class="number total"><?php echo Formatter::number($totalPaid)?></td>
	</tr>
	<tr>
		<td colspan="3" style="text-align:right">Saldo Pendiente: </td>
		<td class="number total"><?php echo Formatter::number($outstanding)?></td>
	</tr>
	<?php if ($sell->paymentType == PAYMENT_TYPE_CREDIT && $outstanding > 0){?>
	<tr>
		<td colspan="3" style="text-align:right">Monto a pagar: </td>
		<td class="number"><input type="text" value="" name="payment" style="width:8em"/></td>
	</tr>
	<?php } ?>
	</tfoot>
	</table>
	
	<input type="hidden" value="<?php echo $sell->status;?>" id="status"/>
	<input type="hidden" value="<?php echo $outstanding;?>" id="outstanding"/>
	<input type="hidden" value="<?php echo $sellid;?>" name="sell"/>
	<input type="hidden" name="page" value="sell_edit"/>
	
	<br/>
	<button id="save">Guardar</button>
</form>
<div id="dialog">
	<div class="alert-list">
		<?php echo ICON_INFO;?>
		<p>Est&aacute; a punto de actualizar los datos de una venta.Esta operaci&oacute;n es irreversible.</p>
		<p>&iquest;Est&aacute; seguro de realizar esta operaci&oacute;n?</p>
	</div>
</div>
<div id="dialog_error"><div class="error-list"></div></div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.default tbody tr:odd').addClass('alternate');
	setupInputDecimalByObj(jQuery('input[name="payment"]'));
	jQuery('#save').button({
		icons:{primary: 'ui-icon-disk'}
	}).click(function(){
		if (!checkChanged())
			return false;
		
		var error = checkData();

		if (!error)
			jQuery('#dialog').dialog('open');
		else{
			jQuery('#dialog_error .error-list').html('<?php echo ICON_ALERT;?>'+error);
			jQuery('#dialog_error').dialog('open');
		}
		
		return false;

	});

	jQuery('#dialog').dialog({
		modal: true,
		autoOpen: false,
		title: '<?php echo ALERT_TITLE;?>',
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
});
function checkChanged(){
	var statusChanged = jQuery('select[name="status"]').val() != jQuery('#status').val();
	var payment = jQuery('input[name="payment"]').val();
	
	return statusChanged || (payment && Number(payment)!=0);
}
function checkData(){
	var payment = jQuery('input[name="payment"]').val();
	var outstanding = Number(jQuery('#outstanding').val());
	var error = '';
	
	if (payment && Number(payment) > outstanding)
		error += '<li>Ha introducido un monto inv&aacute;lido.</li>';

	if (error)	
		error = '<ul>'+error+'</ul>';

	return error;
}
</script>
<?php } ?>