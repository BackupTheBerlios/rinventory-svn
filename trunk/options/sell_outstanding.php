<p class="form-title">Ventas por Cobrar</p>
<?php
if (!Forms::checkPermission(FORM_SELL_OUTSTANDING))
	return;
	
require 'inc/class.sell.php';
require 'inc/class.formatter.php';

$selles = Sell::getAllOutstanding("`date`", "DESC")
?>

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
		echo "<td>$sell->id</td>";
		echo "<td class='date'>$sell->date</td>";
		echo "<td>$sell->customer</td>";
		echo "<td>{$PURCHASE_STATUS[$sell->status]}</td>";
		echo "<td class='number'>".Formatter::number($sell->amount)."</td>";
		echo "<td class='number'>".Formatter::number($sell->outstanding)."</td>";
		echo "<td class='ui-state-default'><a href='index.php?pages=sell_detail&sell=$sell->id' title='Ver'>".ICON_ZOOMIN."</a></td>";
		echo "<td class='ui-state-default'><a href='index.php?pages=sell_edit&sell=$sell->id' title='Editar'>".ICON_PENCIL."</a></td>";
	} 
	?>
</tbody>
</table>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.default tbody tr:odd').addClass('alternate');
});
</script>