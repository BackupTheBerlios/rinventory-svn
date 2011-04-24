<p class="form-title">Compra</p>
<?php
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

if(!$purchase->read($purchaseid, true)){
	$log->addError("No existen datos de Compra solicitada.");
	$isValid = false;	
}

$details = PurchaseDetail::getAll($purchaseid);
$payments = PurchasePayment::getAll($purchaseid);

include 'inc/widget/error.php';

if ($isValid){
?>
<table class="form">
<tr>
	<td class="label">C&oacute;digo:</td>
	<td><?php echo $purchase->code;?></td>
</tr>
<tr>
	<td class="label">Estado</td>
	<td><?php echo $PURCHASE_STATUS[$purchase->status];?></td>
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
<table class="default" id="payments">
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
</tfoot>
</table>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#payments tbody tr:odd,#detail tbody tr:odd').addClass('alternate');
});
</script>
<?php }?>