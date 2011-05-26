<p class="form-title">Listado de Lotes</p>
<?php
if (!Forms::checkPermission(FORM_LOT_LIST))
	return;
	
require_once 'inc/class.item.php';
require_once 'inc/class.store.php';
require_once 'inc/class.queries.php';

$itemid = isset($_GET['item']) && is_numeric($_GET['item']) ? $_GET['item'] : "";
$storeid = isset($_GET['store']) && is_numeric($_GET['store']) ? $_GET['store'] : ""; 
$stores = Store::getAllActive("name");
$lots = Queries::getLotsFromItem($itemid, $storeid);
$item = new Item();

if ($itemid){
	$item->read($itemid);	
}

include 'inc/widget/error.php';
?>

<form action="index.php" method="GET">
	<input type="hidden" name="pages" value="lot_list"/>
	<input type="hidden" name="item" value="<?php echo $itemid;?>"/>
	Ver lotes por almacen:
	<select name="store">
	<option value="">- Todos -</option>
	<?php
	foreach ($stores as $store) {
		echo "<option value='$store->id'".($store->id == $storeid ? " selected='selected'": "").">$store->name</option>";
	} 
	?>
	</select>
	<input type="submit" value="Aceptar"/>
</form>
		
<table class="default">
<thead>
<tr>
	<th>Nro. Lote</th>
	<th>Almacen</th>
	<th>Stock</th>
	<th>Precio Final</th>
	<th>Estado</th>
	<th colspan="2">&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
foreach($lots as $lot){
?>
<tr>
	<td><?php echo $lot['id']; ?></td>
	<td><?php echo $lot['store']; ?></td>				
	<td class="number"><?php echo $lot['stock'];?></td>
	<td class="number"><?php echo $lot['price'];?></td>
	<td style="padding-left:1em"><?php echo $lot['active'] == 1 ? ACTIVE_ON : ACTIVE_OFF;?></td>
	<td class="ui-state-default"><a href="<?php echo Forms::getLink(FORM_LOT_DETAIL, array("lot"=>$lot['id']));?>" title="Ver"><?php echo ICON_ZOOMIN;?></a></td>
	<td class="ui-state-default"><a href="<?php echo Forms::getLink(FORM_LOT_EDIT, array("lot"=>$lot['id']));?>" title="Editar"><?php echo ICON_PENCIL;?></a></td>
</tr>
<?php 
} 
?>
</tbody>
<tfoot>
<?php
$res = $db->query("SELECT dl.idalmacen, ".
	"SUM(dl.stock) stock ".
	"FROM ".TBL_LOT." dl INNER JOIN ".TBL_ITEM." di ON dl.itemid=di.id ".
	"WHERE di.id=$itemid AND dl.active=1 ".	
	($storeid ? "AND dl.idalmacen=$storeid " : "").
	"GROUP BY dl.idalmacen");

	
$stockTotal = 0;
while ($row = $db->getRow($res, 0)){
	$stockTotal += $row['stock'];
 }
?>
<tr>
	<td>&nbsp;</td>
	<td style="text-align:right">Stock Total:</td>
	<td class="total number"><?php echo $stockTotal;?></td>
	<td colspan="4">&nbsp;</td>
</tr>
</tfoot>  	  
</table>
