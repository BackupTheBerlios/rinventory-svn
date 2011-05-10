<p class="form-title">Compra</p>
<?php
if (!Forms::checkPermission(FORM_PURCHASE_EDIT))
	return;

require 'inc/class.purchase.php';
require 'inc/class.formatter.php';

$purchaseid = isset($_GET['purchase']) && is_numeric($_GET['purchase']) ? $_GET['purchase'] : false; 
$log = Log::getInstance();
$isValid = true; 

if (!$purchaseid){
	$log->addError("No existen datos de Compra solicitada.");
	$isValid = false;
}

$purchase = new Purchase();

if(!$purchase->read($purchaseid)){
	$log->addError("No existen datos de Compra solicitada.");
	$isValid = false;	
}

$details = PurchaseDetail::getAll($purchaseid);
$payments = PurchasePayment::getAll($purchaseid);

include 'inc/widget/error.php';

if (isset($_POST['page']) && isset($_POST['purchase']) && !$log->isError()){
	include 'inc/widget/success.php';
}

if($isValid){
?>
<form action="" method="POST" name="form1">
	<table class="form">
	<tr>
		<td class="label">C&oacute;digo:</td>
		<td><?php echo $purchase->code;?></td>
	</tr>
	<tr>
		<td class="label">Estado</td>
		<td>
			<select name="status">
			<?php
			foreach($PURCHASE_STATUS as $key => $label){
				echo "<option value='$key'".($key==$purchase->status ? " selected='selected'" : "").">$label</option>";
			}	 
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label">Fecha:</td>
		<td><?php echo $purchase->date;?></td>
	</tr>
	<tr>
		<td class="label">Anticipo:</td>
		<td><?php echo Formatter::currency($purchase->prepayment);?></td>
	</tr>
	<tr>
		<td class="label">Proveedor:</td>
		<td><?php echo $purchase->provider; ?></td>
	</tr>
	<tr>
		<td class="label">Observaciones:</td>
		<td style="width:15em"><?php echo $purchase->gloss;?></td>
	</tr>
	</table>
	<p class="form-subtitle">Detalle de Compra</p>
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
		<th style="width:30em">Pagado por</th>
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
	<tr>
		<td colspan="3" style="text-align:right">Monto a pagar: </td>
		<td class="number"><input type="text" value="" name="payment" style="width:8em"/></td>
	</tr>
	</tfoot>
	</table>
	
	<input type="hidden" value="<?php echo $purchase->status;?>" id="status"/>
	<input type="hidden" value="<?php echo $outstanding;?>" id="outstanding"/>
	<input type="hidden" value="<?php echo $purchaseid;?>" name="purchase"/>
	<input type="hidden" name="page" value="purchase_edit"/>
	
	<br/>
	<button id="save">Guardar</button>
</form>
<div id="dialog">
	<div class="alert-list">
		<?php echo ICON_INFO;?>
		<p>Est&aacute; a punto de actualizar los datos de una compra.Esta operaci&oacute;n es irreversible.</p>
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