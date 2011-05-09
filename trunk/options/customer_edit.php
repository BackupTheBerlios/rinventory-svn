<p class="form-title">Modificaci&oacute;n de Cliente</p>
<?php
if (!Forms::checkPermission(FORM_CUSTOMER_EDIT))
	return;

require_once 'inc/class.customer.php';
require_once 'inc/class.log.php';

$customerid = isset($_GET['customer']) ? $_GET['customer'] : "";
$log = Log::getInstance();
$customer = new Customer();

if ($customerid)
	$customer->read($customerid);
else 
	$log->addError("Cliente solicitado no es v&aacute;lido.");

include 'inc/widget/error.php';

if (!isset($_POST['page']) && $log->isError())
	return;
	
if (isset($_POST['customerid']) && isset($_POST['page']) && !$log->isError())
	include 'inc/widget/success.php';
?>
<form action="" method="post">
	<table class="form">
	<tbody>
	<tr>
		<td class="label">Nombre:</td>
		<td><input name="name" type="text" id="name" value="<?php echo $customer->name;?>" size="60"/> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">NIT:</td>
		<td><input name="nit" type="text" id="nit" value="<?php echo $customer->nit;?>" size="60"/> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Tel&eacute;fono:</td>
		<td><input name="phone" type="text" value="<?php echo $customer->phone;?>" size="60"/> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Celular:</td>
		<td><input name="cell" type="text" value="<?php echo $customer->cell;?>" size="60"/></td>
	</tr>
	<tr>
		<td class="label">Activo:</td>
		<td><input type="checkbox" id="active" <?php echo $customer->active == 1 ? "checked='checked'" : "";?>><input type="hidden" value="<?php echo $customer->active;?>" name="active"/></td>
	</tr>
	<tr>
		<td class="label">Direcci&oacute;n:</td>
		<td><input name="address" type="text" id="address" value="<?php echo $customer->address;?>" size="60"/> </td>
	</tr>
	<tr>
		<td class="label">E-Mail:</td>
	    <td><input name="email" type="text" id="email" value="<?php echo $customer->email;?>" size="60"/></td>
	</tr>
	</tbody>
	</table>
	<input type="hidden" name="page" value="<?php echo FORM_CUSTOMER_EDIT;?>"/>
	<input type="hidden" name="customerid" value="<?php echo $customerid;?>"/>
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
			jQuery('#dialog_error .error-list').html('<?php echo ICON_ALERT;?>' + error);
			jQuery('#dialog_error').dialog('open');
			return false;
		}
	});
	jQuery('#dialog_error').dialog({
		autoOpen: false,
		modal: true,
		title: '<?php echo ERROR_TITLE;?>',
		buttons: {
			'Aceptar': function(){jQuery(this).dialog("close")}
		}
	});
	jQuery('#active').click(function(){
		jQuery('input[name="active"]').val(this.checked ? 1 : 0);
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