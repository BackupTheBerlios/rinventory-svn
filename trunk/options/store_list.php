<?php
require_once 'inc/class.mysql.php';
$db = Database::getInstance();
 
?>
<p class="form-title">Listado de Almacenes</p>
<table class="default" style="width:99%">
<thead>
<tr>
	<th>Nombre</th>
	<th>Activo</th>
	<th>Nombre de Contacto</th>
	<th>E-Mail</th>
	<th>Tel&eacute;fono</th>
	<th>Productos</th>
</tr>
</thead>
<tbody>		
<?php
$res = $db->query("Select id,name,active,contact_name,email,phone from dvd_departament");

while($row = $db->getRow($res, 0)){  
?>
	<tr>
		<td><a href="index.php?pages=modify_alm&id=<?php echo $row['id'];?>"><?php echo $row['name'];?></a></td>
		<td style="padding-left:1.5em"><span class='ui-icon <?php echo $row['active']==1 ? "ui-icon-check" : "ui-icon-cancel";?>'></span></td>
		<td><?php echo $row['contact_name'];?></td>
		<td><?php echo $row['email'];?></td>
		<td class="date"><?php echo $row['phone'];?></td>
		<td class="date"><a href="index.php?pages=detalle_alm&id=<?php echo $row['id'];?>">Detalles...</a></td>
	</tr>
<?php         
} 
?>     	  
</tbody>
</table>
			  

