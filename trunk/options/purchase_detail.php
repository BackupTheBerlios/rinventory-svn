<?php
require 'inc/class.purchase.php';
require 'inc/class.formatter.php';

$purchaseid = isset($_GET['purchase']) && is_numeric($_GET['purchase']) ? $_GET['purchase'] : false; 

if (!$purchaseid){
	echo "Compra no especificada";
	exit();
}

$purchase = new Purchase();
$purchase->read($_GET['purchase'], true);

?>
<p class="form-title">Detalle de Compra</p>
<table class="form">
<tr>
	<td class="label">C&oacute;digo:</td>
	<td><?php echo $purchase->code;?></td>
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
	<td><div style="width:30em;height:3em"><?php echo $purchase->gloss;?></div></td>
</tr>
</table>

<table class="form">
<tr>
	<td class="label">Detalle de compra</td>
</tr>
<tr>
	<td>
		<div>
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
			
			foreach ($purchase->detail as $detail){
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
		</div>
	</td>
</tr>
</table>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#detail tbody tr:odd').addClass('alternate');
});
</script>