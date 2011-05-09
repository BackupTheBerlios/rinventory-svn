<p class="form-title">Usuarios</p>
<?php
if (!Forms::checkPermission(FORM_USER_LIST))
	return;
	
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
	<th>Estado</th>
	<th colspan="2">&nbsp;</th>
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
		"<td class='ui-state-default'><a href='index.php?pages=user_detail&user={$row['id']}'>".ICON_ZOOMIN."</a></td>".
		"<td class='ui-state-default'><a href='index.php?pages=user_edit&user={$row['id']}'>".ICON_PENCIL."</a></td></tr>";
}
?>
</tbody>
</table>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.default tbody tr:odd').addClass('alternate');
});
</script>