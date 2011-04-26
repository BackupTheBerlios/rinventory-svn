<?php
require 'inc/class.sell.php';
require 'inc/class.formatter.php';

$selles = Sell::getAll("`date`","DESC");
?>
<p class="form-title">Listado de Ventas</p>
<table class="default">
<thead>
	<tr>
		<th style="width:8em">Venta Nro.</th>
		<th style="width:8em">Fecha</th>
		<th style="width:12em">Cliente</th>
		<th>Estado</th>
		<th style="width:8em">Monto <?php echo SB_CURRENCY;?></th>
		<th style="width:8em">Saldo <?php echo SB_CURRENCY;?></th>
		<th colspan="2">&nbsp;</th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($selles as $sell){
		echo "<tr>";
		echo "<td class='number'>$sell->id</td>";
		echo "<td class='date'>".Formatter::date($sell->date)."</td>";
		echo "<td>$sell->provider</td>";
		echo "<td>{$PURCHASE_STATUS[$sell->status]}</td>";
		echo "<td class='number'>".Formatter::number($sell->amount)."</td>";
		echo "<td class='number'>".Formatter::number($sell->amount - Sell::getAmountPaid($sell->id))."</td>";
		echo "<td class='ui-state-default'><a href='index.php?pages=sell_detail&sell=$sell->id' title='Ver'>".ICON_ZOOMIN."</a></td>";
		echo "<td class='ui-state-default'><a href='index.php?pages=sell_edit&sell=$sell->id' title='Editar'>".ICON_PENCIL."</a></td>";
		echo "</tr>";
	} 
	?>
</tbody>
</table>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.default tbody tr:odd').addClass('alternate');
});
</script>