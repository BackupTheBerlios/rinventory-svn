<?php
require_once 'inc/class.queries.php';
require_once 'inc/class.store.php';

$stores = Store::getAllActive('', '');
?>
<table class="default">
<tr>
	<?php 
	foreach($stores as $store){
		echo "<td colspan='2'>$store->name</td>";
	}
	?>
</tr>
<tr>
	<?php
	foreach ($stores as $store) {
		echo "<th>Item</th><th>Stock</th>";
	}
	?>
</tr>
	<?php 
	foreach($stores as $store){
		$itemsStock = Queries::getStock($store->id);
		foreach($itemsStock as $row){
			echo "<tr>";
			echo "<td>{$row['name']}</td>";
			echo "<td>{$row['stock']}</td>";
			echo "</tr>";
		}
	}
	?>
</table>
