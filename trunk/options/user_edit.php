<p class="form-title">Datos de Usuario</p>
<?php
if (!Forms::checkPermission(FORM_USER_EDIT))
	return;
	
require 'inc/class.store.php'; 
require 'inc/class.user.php';
require_once 'inc/class.log.php';

$userid = isset($_GET['user']) ? $_GET['user'] : "";
$user = new User();
$stores = Store::getAllActive("name", "ASC");
$log = Log::getInstance();

if ($userid)
	$user->read($userid);

include 'inc/widget/error.php';

if (isset($_POST['page']) && isset($_POST['user']) && !$log->isError())
	include 'inc/widget/success.php';
?>
<form action="" method="POST" enctype="multipart/form-data">
	<table class="form">
	<tbody>
	<tr>
		<td class="label">Nombre:</td>
		<td><input name="firstname" type="text" value="<?php echo $user->firstname;?>" size="60"/> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Apellidos:</td>
		<td><input name="lastname" type="text" value="<?php echo $user->lastname;?>" size="60"/> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Usuario:</td>
		<td><input name="username" type="text" value="<?php echo $user->username;?>" size="25"/> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Contrase&ntilde;a:</td>
		<td><input name="passwd" type="password" value="" size="25"/> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Verificar Contrase&ntilde;a:</td>
		<td><input name="passwd2" type="password" value="" size="25"> <span class="mandatory">*</span></td>
	</tr>	           
	<tr>
		<td class="label">C.I.:</td>
		<td><input name="ci" type="text" value="<?php echo $user->ci;?>" size="25"> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Activo:</td>
		<td><input name="active" type="checkbox" value="1" <?php echo $user->active ? "checked=\"checked\"" : "";?> /></td>
	</tr>
	<tr>
		<td class="label">Rol de Usuario:</td>
		<td>
			<select name="role">
			<option value="">-Seleccione-</option>
			<?php 
			foreach($ROLE_LEVEL as $key => $value){
				echo "<option value='$key'".($user->level == $key ? " selected='selected'" : "").">$value</option>";
			} 
			?>
			</select>
		</td>
	</tr>                  
	<tr>
		<td class="label">Direcci&oacute;n:</td>
		<td><input name="address" type="text" value="<?php echo $user->address;?>" size="60"/> </td>
	</tr>
	<tr>
		<td class="label">Tel&eacute;fono:</td>
		<td><input name="phone" type="text" value="<?php echo $user->phone;?>" size="60"/> </td>
	</tr>
	<tr>
		<td class="label">Almacen:</td>
		<td>
			<select name="store">
			<option value="">&nbsp;</option>
			<?php
			foreach($stores as $row){
				echo "<option value='$row->id'".($row->id==$store ? " selected=\"selected\"" : "").">$row->name</option>";
			}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label">E-Mail:</td>
		<td><input name="email" type="text" value="<?php echo $user->email;?>" size="60"/></td>
	</tr>
	<tr>
		<td class="label">Imagen:</td>
		<td colspan="2"><input name="upload" type="file" id="upload" size="60"/> &nbsp;Tama&ntilde;o Max : 2M</td>
	</tr>
	</tbody>
	</table>
	<input type="hidden" name="page" value="user_edit"/>
	<input type="hidden" name="user" value="<?php echo $userid; ?>"/>
	<br/>
	<button id="save">Guardar</button>
</form>
<div id="dialog_error"><div class="error-list"></div></div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#save').button({
		icons:{primary: 'ui-icon-disk'}
	}).click(function(){
		var error = checkData(); 

		if (error){
			jQuery('#dialog_error .error-list').html('<span class="ui-icon ui-icon-alert"></span>' + error);
			jQuery('#dialog_error').dialog('open');
			return false;
		}
	});
	jQuery('#dialog_error').dialog({
		autoOpen: false,
		modal: true,
		title: 'Se detectaron Errores!',
		buttons: {
			'Aceptar': function(){jQuery(this).dialog("close")}
		}
	});
});
function checkData(){
	var error = '';

	if (!jQuery('input[name="firstname"]').val())
		error += '<li>Debe introducir Nombre</li>';
	
	if (!jQuery('input[name="lastname"]').val())
		error += '<li>Debe introducir Apellidos</li>';

	if (!jQuery('input[name="username"]').val())
		error += '<li>Debe introducir Usuario</li>';

	if (!jQuery('input[name="ci"]').val())
		error += '<li>Debe introducir CI</li>';

	if (jQuery('input[name="passwd"]').val() != jQuery('input[name="passwd2"]').val())
		error += '<li>Contrase&ntilde;s no coinciden</li>';
	
	if (error)
		error = '<ul>' + error + '<ul>';

	return error;
}
</script>