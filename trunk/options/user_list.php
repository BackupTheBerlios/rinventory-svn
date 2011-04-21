<?php
require 'inc/class.user.php';

$users = User::getAll();
?>

<table class="default">
<thead>
<tr>
	<th style="width:10em">Usuario</th>
	<th style="width:15em">Nombre</th>
	<th style="width:15em">Apellido</th>
	<th style="width:10em">Email</th>
	<th style="width:8em">Tel&eacute;fono</th>
	<th>Activo</th>
	<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php
foreach($users as $row){
	echo "<tr><td>{$row['username']}</td>".
		"<td>{$row['firstname']}</td>".
		"<td>{$row['lastname']}</td>".
		"<td>{$row['email']}</td>".
		"<td>{$row['phone']}</td>".
		"<td class='date'>".($row['active'] == 1 ? ACTIVE_ON : ACTIVE_OFF)."</td>".
		"<td><a href='index.php?pages=user_detail&user={$row['id']}'><span class='ui-icon ui-icon-zoomin'></span></a></td>";
}
?>
</tbody>
</table>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.default tbody tr:odd').addClass('alternate');
});
</script>