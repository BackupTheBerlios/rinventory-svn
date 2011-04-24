<?php
require_once 'inc/class.mysqli.php';

$db = Database::getInstance();
?>
<p class="form-title">Listado de Productos</p>
<table class="default" style="width:99%">
<thead>
<tr>
	<th>Nombre</th>
	<th>Grupo</th>
	<th>Stock M&iacute;nimo</th>
	<th>Stock Total</th>
	<th>Valor Unitario</th>
	<th>Valor Caja</th>
	<th>Valor Paquete</th>		
	<th>Lote</th>
	<th>Imagen</th>
</tr>
</thead>
<tbody>
<?php 
$res = $db->query("SELECT id,link_type_item as titem,v_descr as name,link_marca as marca,stock_total,stock_min,price_unit,price_box,price_paq,image FROM ". TBL_ITEM);

while($row = $db->getRow($res, 0)) {
	$qry = $db->query("SELECT di.id, dl.id as idlote FROM ". 
		TBL_ITEM ." di INNER JOIN ". TBL_LOT ." dl ON di.id=dl.id ".
		"WHERE dl.itemid='{$row['id']}'");
		
	$rwy = $db->getRow($qry, 0);	 

	if ($row['titem']=='Dvd-cd')
		$titem="multiple";
	else {
		if ($row['titem']=='Estuches')
			$titem="normal";
		else 
			$titem="stnd";
	}					 
?>
<tr>
	<td><a href="index.php?pages=modify&item=<?php echo $titem;?>&id=<?php echo $row['id'];?>"><?php echo $row['name'];?></a></td>
	<td><?php echo $row['titem'];?></td>
	<td class="number"><?php echo $row['stock_min'];?></td>
	<td class="number"><?php echo $row['stock_total'];?></td>
	<td class="number"><?php echo $row['price_unit'];?></td>
	<td class="number"><?php echo $row['price_paq'];?></td>
	<td class="number"><?php echo $row['price_box'];?></td>
	<td class="date"><strong><a href="index.php?pages=lote_list&itemid=<?php echo $row['id']?>">Ver Lotes</a><br/><a href="index.php?pages=lote_new&itemid=<?php echo $row['id']?>">Nuevo Lote</a></strong></td>    
	<td align="center"><img src="<?php echo $row['image'];?>" height="50"></td>
</tr>
<?php 
} 
?>     	
</tbody>
</table>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.default tbody tr:odd').addClass('alternate');
});
</script>