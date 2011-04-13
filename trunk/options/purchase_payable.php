<?php
require 'inc/class.purchase.php';
require 'inc/class.formatter.php';

$rows = Purchase::getAllOutstanding("`date`", "DESC")
?>
<p class="form-title">Compras por Pagar</p>
<table class="default">
<thead>
	<tr>
		<th style="width:8em">C&oacute;digo</th>
		<th style="width:8em">Fecha</th>
		<th style="width:12em">Proveedor</th>
		<th>Observaci&oacute;n</th>
		<th style="width:8em">Monto <?php echo SB_CURRENCY;?></th>
		<th style="width:8em">Saldo <?php echo SB_CURRENCY;?></th>
		<th>&nbsp;</th>
	</tr>
</thead>
<tbody>
	<?php
	foreach ($rows as $row){
		echo "<tr><td><a href='index.php?pages=purchase_detail&purchase={$row['id']}'>{$row['code']}</a></td>".
			"<td class='date'>{$row['date']}</td>".
			"<td>{$row['provider']}</td>".
			"<td>".Formatter::text($row['gloss'])."</td>".
			"<td class='number'>".Formatter::number($row['amount'])."</td>".
			"<td class='number'>".Formatter::number($row['outstanding'])."</td>".
			"<td><a href='index.php?pages=purchase_detail&purchase={$row['id']}&action=pay'>Pagar</a></td></tr>";
	} 
	?>
</tbody>
</table>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.default tbody tr:odd').addClass('alternate');
});
</script>