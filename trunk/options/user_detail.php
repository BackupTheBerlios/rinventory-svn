<?php
if (!Forms::checkPermission(FORM_USER_DETAIL))
	return;
	
require 'inc/class.store.php'; 
require 'inc/class.user.php';
require_once 'inc/class.log.php';

$userid = isset($_GET['user']) && is_numeric($_GET['user']) ? $_GET['user'] : -1; 
$user = new User();
$store = new Store();

if(!$user->read($userid)){
	$log = Log::getInstance();
	$log->addError("Informaci&oacute;n de Usuario no disponible");
}
else if($user->storeid)
	$store->read($user->storeid);
?>
<p class="form-title">Informaci&oacute;n de Usuario</p>
	<?php include 'inc/widget/error.php'; ?>
	<table class="form">
	<tbody>
	<tr>
		<td class="label">Nombre:</td>
		<td><?php echo $user->firstname;?></td>
		<td><?php echo $user->imagepath ? "<img src='$user->imagepath' />" : "&nbsp;";	?></td>
	</tr>
	<tr>
		<td class="label">Apellidos:</td>
		<td><?php echo $user->lastname?></td>
	</tr>
	<tr>
		<td class="label">Usuario:</td>
		<td><?php echo $user->username; ?></td>
	</tr>	           
	<tr>
		<td class="label">C.I.:</td>
		<td><?php echo $user->ci; ?></td>
	</tr>
	<tr>
		<td class="label">Activo:</td>
		<td><?php echo $user->active ? "Si" : "No"; ?></td>
	</tr>
	<tr>
		<td class="label">Rol de Usuario:</td>
		<td>
			<?php
			if ($user->level == ADMIN_LEVEL)
				echo "Administrador";
			else if ($user->level == USER_LEVEL)
				echo "Normal";
			?>
		</td>
	</tr>                  
	<tr>
		<td class="label">Direcci&oacute;n:</td>
		<td><?php echo $user->address; ?></td>
	</tr>
	<tr>
		<td class="label">Tel&eacute;fono:</td>
		<td><?php echo $user->phone; ?></td>
	</tr>
	<tr>
		<td class="label">Almacen:</td>
		<td><?php echo $store->name; ?></td>
	</tr>
	<tr>
		<td class="label">E-Mail:</td>
		<td><?php echo $user->email; ?></td>
	</tr>
	</tbody>
	</table>

