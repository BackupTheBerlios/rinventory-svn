<p class="form-title">Detalle de Lote</p>
<?php
require_once 'inc/class.item.php';
require_once 'inc/class.store.php';
require_once 'inc/class.lot.php';
require_once 'inc/class.formatter.php';

$lot = new Lot();
$item = new Item();
$store = new Store();
$lotid = isset($_GET['lot']) && is_numeric($_GET['lot'])? $_GET['lot'] : 0;

if ($lot->read($lotid)){
	$item->read($lot->itemid);
	$store->read($lot->storeid);
}

include 'inc/widget/error.php';
?>

<table class="form">
<tr>
	<td class="label">Lote Nro.:</td>
	<td><?php echo $lot->id;?></td>
</tr>
<tr>
	<td class="label">Producto:</td>
	<td><?php echo "$item->name, $item->type</span>";?></td>
</tr>
<tr>
	<td class="label">Cajas:</td>
	<td><?php echo $lot->boxes;?></td>
</tr>
<tr>
	<td class="label">Unidades:</td>
	<td><?php echo $lot->units;?></td>
</tr>
<tr>
	<td class="label">Stock:</td>
	<td class="number"><?php echo $lot->stock;?></td>
</tr>
<tr>
	<td class="label">Activo:</td>
	<td><?php echo $lot->active == 1 ? ICON_ACTIVE : ICON_INACTIVE;?></td>
</tr>
<tr>
	<td class="label">Almacen</td>
	<td><?php echo $store->name;?></td>
</tr>
<tr>
	<td class="label">Costo:</td>
	<td class="number"><?php echo Formatter::number($lot->cost);?></td>
</tr>
<tr>
	<td class="label">Transporte Maritimo:</td>
	<td><?php echo Formatter::number($lot->costMar);?></td>
</tr>            
<tr>
	<td class="label">Transporte Terrestre:</td>
	<td><?php echo Formatter::number($lot->costTer);?></td>
</tr>
<tr>
	<td class="label">Aduana:</td>
	<td><?php echo Formatter::number($lot->costAdu);?></td>
</tr>
<tr>
	<td class="label">Transferencia Bancaria:</td>
	<td><?php echo Formatter::number($lot->costBank);?></td>
</tr>
<tr>
	<td class="label">Carguio / Desacargio:</td>
	<td><?php echo Formatter::number($lot->costLoad);?></td>
</tr>
<tr>
	<td class="label">Otros:</td>
	<td><?php echo Formatter::number($lot->costOther);?></td>
</tr>
<tr>
	<td class="label">Precio Final:</td>
	<td><?php echo Formatter::number($lot->price);?> ( Precio final de compra)</td>
</tr>
<tr>
	<td class="label">Observaciones:</td>
	<td><?php echo $lot->gloss;?></td>
</tr>
</table>
<br />
<!-- <button id="save">Guardar</button>  -->
