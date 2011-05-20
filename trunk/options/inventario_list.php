<p class="form-title">Listado de Productos</p>
<?php
if(!Forms::checkPermission(FORM_ITEM_LIST))
	return;
	
require_once 'inc/class.mysqli.php';
require_once 'inc/class.item.php';
require_once 'inc/class.store.php';
require_once 'inc/class.formatter.php';

$db = Database::getInstance();
$stores = Store::getAllActive("");

?>

<div id="tabs">
	<ul>
	<?php 
	foreach ($stores as $store){
		echo "<li><a href='#tab_$store->id'>$store->name</a></li>";
	}
	?>
	</ul>
	<?php 
	foreach ($stores as $store){
	?>
	<div id="tab_<?php echo $store->id;?>">
		<table class="default" style="width:99.9%">
		<thead>
		<tr>
			<th>Nombre</th>
			<th>Grupo</th>
			<th>Stock M&iacute;nimo</th>
			<th>Stock Total</th>
			<th>Precio Unitario</th>
			<th>Precio Caja</th>
			<th>Precio Paquete</th>		
			<th>Lote</th>
			<th>Imagen</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$items = Item::getAllFromStore($store->id, "", "");
		foreach ($items as $item){
			$titem = ""; 
			if ($item->type =='Dvd-cd')
				$titem="multiple";
			else if ($item->type == 'Estuches')
				$titem="normal";
			else 
				$titem="stnd";
		?>
		<tr>
			<?php
			$urlLotNew = Forms::getLink(FORM_LOT_NEW, array("item" => $item->id, "store" => $store->id));
			?>
			<td><a href="index.php?pages=modify&item=<?php echo $titem;?>&id=<?php echo $item->id;?>"><?php echo $item->name;?></a></td>
			<td><?php echo $item->type;?></td>
			<td class="number"><?php echo $item->stockMin;?></td>
			<td class="number"><?php echo $item->stock;?></td>
			<td class="number"><?php echo Formatter::number($item->priceUnit);?></td>
			<td class="number"><?php echo Formatter::number($item->pricePack);?></td>
			<td class="number"><?php echo Formatter::number($item->priceBox);?></td>
			<td class="date"><a href="index.php?pages=lote_list&itemid=<?php echo $item->id;?>">Ver Lotes</a><br/><a href="<?php echo $urlLotNew;?>">Nuevo Lote</a></td>    
			<td class="date"><img src="<?php echo $item->image;?>" height="50"/></td>
		</tr>
		<?php } ?>
		</tbody>
		</table>
	</div>
	<?php } ?>
</div>


<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#tabs').tabs({
		create:function(event, ui){
			jQuery(this).removeClass('ui-widget-content');	
		}
	});
	jQuery('.default tbody tr:odd').addClass('alternate');
});
</script>





