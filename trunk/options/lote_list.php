<?php
require_once 'inc/class.mysqli.php';

$db = Database::getInstance();
$itemid = isset($_GET['itemid']) ? $_GET['itemid'] : -1;
$storeid = isset($_GET['storeid']) ? $_GET['storeid'] : false; 

$res = $db->query("SELECT v_descr as name FROM ".TBL_ITEM." WHERE id=$itemid");
$row = $db->getRow($res, 0);
?>
<p class="form-title">Listado de Lotes</p>
		<form action="index.php" method="GET">
			<input type="hidden" name="pages" value="lote_list"/>
			<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
			Ver lotes por almacen:
			<select name="storeid">
			<option value="">- Todos -</option>
<?php 
$res = $db->query("SELECT id, name FROM ".TBL_DEPARTMENT." ORDER BY name");

while($row = $db->getRow($res, 0)){
	echo "<option value=\"{$row['id']}\"". (isset($_GET['storeid']) && $_GET['storeid']==$row['id'] ? " selected=\"selected\"" : "") . ">{$row['name']}</option>";
}
?>
			</select>
			<input type="submit" value="Aceptar"/>
		</form>
		
		<form action="index.php?pages=lote_new" method="post" name="adminForm">
			<table class="default" style="width:99%">
			<thead>
			<tr>
				<th>Lote #</th>
				<th>Almacen</th>
				<th>Stock</th>
				<th>Precio Final</th>
				<th>Activo</th>
			</tr>
			</thead>
			<tbody>
<?php
$res = $db->query("SELECT dl.id, ".
	"di.link_type_item as name, ".
	"dl.idalmacen, ".
	"dd.name store, ".
	"di.material, ".
	"dl.stock, ".
	"dl.active, ".
	"dl.price_final ".
	"FROM ".TBL_LOT." dl INNER JOIN ".TBL_ITEM." di ON dl.name=di.id INNER JOIN ".TBL_DEPARTMENT." dd ON dd.id=dl.idalmacen ".
	"WHERE di.id=$itemid AND dl.stock>0 ".	($storeid ? "AND dd.id=$storeid" : ""));

$sw=0;
$cnt=1;

while($row = $db->getRow($res, 0)) {
	$sim="tick.png";
	
	if($row['active']==0)
		$sim="publish_x.png";  
?>
			
			<tr class="row<?php echo $sw;?>">
				<td align="center"> <?php echo $row['id']; ?> </td>
				<td><?php echo $row['store']; ?></td>				
				<td class="number"><?php echo $row['stock'];?></td>
				<td class="number"><?php echo $row['price_final'];?></td>
				<td class="date"><img src="img/sweb/<?php echo $sim;?>" alt="Activo" border="0"/></td>
				<!-- <td><a href="index.php?pages=modify_lot&id=<?php echo $row['id'];?>"><img src="img/sweb/application_form_edit.png" border="0"/></a></td> -->
			</tr>
<?php 
	$sw = $sw == 0 ? 1 :0;	
	$cnt++;        
} 
?>
			</tbody>
			<tfoot>
<?php
$res = $db->query("SELECT dl.idalmacen, ".
	"SUM(dl.stock) stock ".
	"FROM ".TBL_LOT." dl INNER JOIN ".TBL_ITEM." di ON dl.name=di.id ".
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
				<td>&nbsp;</td>
			</tr>
			</tfoot>  	  
			</table>


			<table class="adminlist">
			<tr>
				
			</tr>
			</table>

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
