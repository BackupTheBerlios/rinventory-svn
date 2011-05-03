<p class="form-title">Cliente</p>
<?php
require 'inc/class.customer.php';
require_once 'inc/class.log.php';

$customerid = isset($_GET['customer']) ? $_GET['customer'] : "";
$log = Log::getInstance();
$customer = new Customer();


if ($customerid != "new" && (!$customerid || !$customer->read($customerid))){
	$log->addError("");
}

include 'inc/widget/error.php';

if (isset($_POST['customerid']) && isset($_POST['page']) && !$log->isError())
	include 'inc/widget/success.php'
?>
<form action="" method="post">
	<table class="form">
	<tbody>
	<tr>
		<td class="label">Nombre:</td>
		<td><input name="name" type="text" id="name" value="<?php echo $customer->name;?>" size="60"> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">NIT:</td>
		<td><input name="nit" type="text" id="nit" value="<?php echo $customer->nit;?>" size="60"> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Tel&eacute;fono:</td>
		<td><input name="phone" type="text" id="phone" value="<?php echo $customer->phone;?>" size="60"> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Celular:</td>
		<td><input name="cell" type="text" id="fax" value="<?php echo $store->fax;?>" size="60"></td>
	</tr>
	<tr>
		<td class="label">Activo:</td>
		<td><input name="active" type="checkbox" id="active" value="1" <?php echo $customer->active == 1 ? "checked='checked'" : "";?>></td>
	</tr>
	<tr>
		<td class="label">Direcci&oacute;n:</td>
		<td><input name="address" type="text" id="address" value="<?php echo $customer->address;?>" size="60"> </td>
	</tr>
	<tr>
		<td class="label">E-Mail:</td>
	    <td><input name="email" type="text" id="email" value="<?php echo $store->email;?>" size="60"></td>
	</tr>
	</tbody>
	</table>
	<input type="hidden" name="customerid" value="<?php echo $customerid;?>"/>
	<input type="hidden" name="page" value="customer_edit"/>
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
	
	if (!jQuery('input[name="nit"]').val())
		error += '<li>Debe introducir NIT</li>';

	if (!jQuery('input[name="phone"]').val())
		error += '<li>Debe introducir Tel&eacute;fono</li>';
	
	if (error)
		error = '<ul>' + error + '<ul>';

	return error;
}
</script>