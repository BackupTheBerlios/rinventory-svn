<?php
require_once 'inc/class.store.php';

$db = Database::getInstance();
$session = Session::getInstance();
$storeid = isset($_GET['storeid']) ? $_GET['storeid'] : false; 
$stores = Store::getAllActive('name', 'ASC');

if ($session->userlevel < USER_LEVEL)
	die("Acceso Denegado");
	
if (isset($_POST['data_row'])){
	// Traspaso de lotes	
	foreach($_POST['data_row'] as $row){
		$jsonRow = json_decode(urldecode($row));
		Store::transfer($jsonRow->source, $jsonRow->target, $jsonRow->stock, $session->uniqueid);		
	}
}

?>
<p class="form-title">Traspasos</p>
		

		<form action="index.php" method="GET">
			<input type="hidden" name="pages" value="traspaso_new"/>
			Ver lotes por almacen:
			<select name="storeid">
			<option value="">- Todos -</option>
<?php 
foreach($stores as $store){
	echo "<option value=\"{$store['id']}\"". (isset($_GET['storeid']) && $_GET['storeid']==$store['id'] ? " selected=\"selected\"" : "") . ">{$store['name']}</option>";
}
?>
			</select>
			<input type="submit" value="Aceptar"/>
		</form>
		
<form action="" method="POST" id="main_form">
	<table class="default" id="main_table">
	<thead>
		<tr>
			<th><input name="toggle" value="" onClick="checkAll(2);" type="checkbox"></th>
			<th>Lote</th>
			<th style="width:17em">Producto</th>
			<th style="width:8em">Almacen</th>
			<th style="width:8em">Stock</th>
			<th>Traspaso</th>
		</tr>
	</thead>
<?php
$res = $db->query("SELECT l.id, ".
	"i.link_type_item as category, ".
	"i.v_descr name, ".
	"l.idalmacen storeid, ".
	"d.name store, ".
	"i.material, ".
	"l.stock ".
	"FROM ".TBL_LOT." l INNER JOIN ".TBL_ITEM." i ON l.name=i.id INNER JOIN ".TBL_DEPARTMENT." d ON d.id=l.idalmacen ".
	"WHERE l.stock>0 AND l.active=1 ".
	($storeid ? "AND d.id=$storeid" : ""));

$sw=0;
$cnt=1;

while($row = $db->getRow($res, 0)) {	
?>
			
			<tr class="row<?php echo $sw;?>">
				<td class="number"><input class="check-row" type="checkbox"> <input type="hidden" value="" class="data-row"/></td>
				<td class="lot number"> <?php echo $row['id']; ?> </td>
				<td><?php echo $row['category']." &rarr; ".$row['name']?></td>
				<td><?php echo $row['store']; ?></td>
				<td class="stock number"><?php echo $row['stock'];?></td>
				<td>
					<input type="text" class="stock-send" value="<?php echo $row['stock'];?>" size="5"/>
					<select class="store-target">
					<option value="">-Sin Cambio-</option>
<?php
	foreach($stores as $store){
		if ($store['id'] != $row['storeid'])
			echo "<option value=\"{$store['id']}\">{$store['name']}</option>";
}
?>
					</select>
				</td>
			</tr>
<?php 
	$sw = $sw == 0 ? 1 :0;	
	$cnt++;        
} 
?>     	
			<tfoot>
			<tr>
				<td colspan="4" style="text-align:right">Stock Total:</td>
				<td class="total number">
<?php
$res = $db->query("SELECT dl.idalmacen, ".
	"SUM(dl.stock) stock ".
	"FROM ".TBL_LOT." dl INNER JOIN ".TBL_ITEM." di ON dl.name=di.id ".
	"WHERE dl.active=1 ".	
	($storeid ? "AND dl.idalmacen=$storeid " : "").
	"GROUP BY dl.idalmacen");

	
$stockTotal = 0;
while ($row = $db->getRow($res, 0)){
	$stockTotal += $row['stock'];
}
echo $stockTotal; 
?>
				</td>
			</tr>
			</tfoot>
			</table>

			<input type="button" value="Guardar" onclick="save()"/>
			<input name="option" value="com_departamentos" type="hidden">
			<input name="section" value="" type="hidden">
			<input name="task" value="" type="hidden">  
			<input name="chosen" value="" type="hidden">
			<input name="act" value="" type="hidden">
			<input name="boxchecked" value="0" type="hidden">
			<input name="type" value="list" type="hidden">
			<input name="order" type="hidden" id="order" value="{FORM_ORDER_BY}">
			<input name="flag_order" type="hidden" id="flag_order" value="0">
		</form>

<script type="text/javascript">
jQuery(document).ready(function(){
	setupInputIntegerByObj(jQuery('input.stock-send'));
});
function save(){
	var error = '';
	
	jQuery('#main_table select.store-target').each(function(){
		var jTr = jQuery(this).closest('tr');
		var jDataRow = jTr.find('input.data-row');
		var stock = Number(jTr.find('.stock').text());
		var obj = new Object();	

		obj.stock = Number(jTr.find('.stock-send').val());
		obj.target = Number(jTr.find('.store-target').val());
		obj.source = Number(jTr.find('.lot').text());
		
		if (obj.target == ''){
			jDataRow.val('');
			jDataRow.removeAttr('name');
		}
		else {
			if (obj.stock <= 0 || obj.stock > stock)
				error += 'El stock ingresado (' + obj.stock + ') es incorrecto\r\n';

			if (!error){
				jDataRow.val(escape(JSON.stringify(obj)));
				jDataRow.attr('name', 'data_row[]');
			}	
		}
	});

	if (error)
		alert(error);
	else
		document.forms['main_form'].submit();
}
</script>