<?php
require 'inc/class.purchase.php';
require 'inc/class.formatter.php';

$purchases = Purchase::getAllOutstanding("`date`", "DESC")
?>
<p class="form-title">Compras por Pagar</p>
<table class="default">
<thead>
	<tr>
		<th style="width:8em">C&oacute;digo</th>
		<th style="width:8em">Fecha</th>
		<th style="width:12em">Proveedor</th>
		<th>Estado</th>
		<th>Observaci&oacute;n</th>
		<th style="width:8em">Monto <?php echo SB_CURRENCY;?></th>
		<th style="width:8em">Saldo <?php echo SB_CURRENCY;?></th>
		<th colspan="2">&nbsp;</th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($purchases as $purchase){
		echo "<tr>";
		echo "<td>$purchase->code</td>";
		echo "<td class='date'>$purchase->date</td>";
		echo "<td>$purchase->provider</td>";
		echo "<td>{$PURCHASE_STATUS[$purchase->status]}</td>";
		echo "<td>".Formatter::text($purchase->gloss)."</td>";
		echo "<td class='number'>".Formatter::number($purchase->amount)."</td>";
		echo "<td class='number'>".Formatter::number($purchase->outstanding)."</td>";
		echo "<td class='ui-state-default'><a href='index.php?pages=purchase_detail&purchase=$purchase->id' title='Ver'>".ICON_ZOOMIN."</a></td>";
		echo "<td class='ui-state-default'><a href='index.php?pages=purchase_edit&purchase=$purchase->id' title='Editar'>".ICON_PENCIL."</a></td>";
	} 
	?>
</tbody>
</table>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.default tbody tr:odd').addClass('alternate');
});
</script>