<p class="form-title">Almacen</p>
<?php
require 'inc/class.store.php';
require_once 'inc/class.log.php';

$storeid = isset($_GET['store']) ? $_GET['store'] : "";
$log = Log::getInstance();
$store = new Store();


if ($storeid != "new" && (!$storeid || !$store->read($storeid))){
	$log->addError("");
}

include 'inc/widget/error.php';

if (isset($_POST['storeid']) && isset($_POST['page']) && !$log->isError())
	include 'inc/widget/success.php'
?>
<form action="" method="post" enctype="multipart/form-data">
	<table class="form">
	<tbody>
	<tr>
		<td class="label">Nombre:</td>
		<td><input name="name" type="text" id="name" value="<?php echo $store->name;?>" size="60"> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Nombre de Contacto:</td>
		<td><input name="contact" type="text" id="contact" value="<?php echo $store->contact;?>" size="60"> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Tel&eacute;fono:</td>
		<td><input name="phone" type="text" id="phone" value="<?php echo $store->phone;?>" size="60"> <span class="mandatory">*</span>     </td>
	</tr>
	<tr>
		<td class="label">Activo:</td>
		<td><input name="active" type="checkbox" id="active" value="1" <?php echo $store->active == 1 ? "checked='checked'" : "";?>></td>
	</tr>
	<tr>
		<td class="label">Direcci&oacute;n:</td>
		<td><input name="address" type="text" id="address" value="<?php echo $store->address;?>" size="60"> </td>
	</tr>
	<tr>
		<td class="label">Fax:</td>
		<td><input name="fax" type="text" id="fax" value="<?php echo $store->fax;?>" size="60"></td>
	</tr>
	<tr>
		<td class="label">E-Mail:</td>
	    <td><input name="email" type="text" id="email" value="<?php echo $store->email;?>" size="60"></td>
	</tr>
	<tr>
		<td class="label">Descripci&oacute;n</td>
		<td><textarea name="description" cols="60" rows="7"><?php echo $store->description;?></textarea></td>
	</tr>
	</tbody>
	</table>
	<input type="hidden" name="storeid" value="<?php echo $storeid;?>"/>
	<input type="hidden" name="page" value="store_edit"/>
	<br />
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

	if (!jQuery('input[name="name"]').val())
		error += '<li>Debe introducir Nombre</li>';
	
	if (!jQuery('input[name="contact"]').val())
		error += '<li>Debe introducir Nombre de Contacto</li>';

	if (!jQuery('input[name="phone"]').val())
		error += '<li>Debe introducir Tel&eacute;fono</li>';
	
	if (error)
		error = '<ul>' + error + '<ul>';

	return error;
}
</script>