<?php
require_once 'inc/class.queries.php';
require_once 'inc/class.store.php';

$stores = Store::getAllActive('', '');
?>
<div style="font-size:0.9em">
	<p class="form-subtitle">Stock en almacenes</p>
	<?php 
	foreach($stores as $store){
		echo "<table class='default' style='float:left;margin-right:0.2em'>";
		echo "<caption style='text-align:center'>$store->name</caption>";
		echo "<thead><tr><th>Item</th><th>Stock</td></tr></thead>";
		
		$itemsStock = Queries::getStock($store->id, "stock", "ASC", 10);

		foreach($itemsStock as $row){
			echo "<tr>";
			echo "<td>{$row['name']}</td>";
			echo "<td class='number".($row['stock'] < $row['stock_min'] ? " mandatory" : "")."'>{$row['stock']}</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	?>
	<br style="clear:both"/>
	<p>Los items de <span class="mandatory">color</span> estan por debajo del stock m&iacute;nimo.</p>
</div>
