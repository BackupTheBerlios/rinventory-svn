<p class="form-title">Informaci&oacute;n de Cliente</p>
<?php
if (!Forms::checkPermission(FORM_CUSTOMER_DETAIL))
	return;

require 'inc/class.customer.php';
require_once 'inc/class.log.php';

$log = Log::getInstance();
$customerid = isset($_GET['customer']) && is_numeric($_GET['customer']) ? $_GET['customer'] : "";
$customer = new Customer();

if ($customerid)
	$customer->read($customerid);
else 
	$log->addError("Cliente solicitado no es v&aacute;lido.");

include 'inc/widget/error.php';

if(!$log->isError()){
?>

<table class="form">
<tbody>
<tr>
	<td class="label">Nombre:</td>
	<td><?php echo $customer->name;?></td>
</tr>
<tr>
	<td class="label">NIT:</td>
	<td><?php echo $customer->nit;?></td>
</tr>
<tr>
	<td class="label">Tel&eacute;fono:</td>
	<td><?php echo $customer->phone;?></td>
</tr>
<tr>
	<td class="label">Celular:</td>
	<td><?php echo $customer->cell;?></td>
</tr>
<tr>
	<td class="label">Activo:</td>
	<td><?php echo $customer->active == 1 ? ICON_ACTIVE : ICON_INACTIVE;?></td>
</tr>
<tr>
	<td class="label">Direcci&oacute;n:</td>
	<td><?php echo $customer->address;?></td>
</tr>
<tr>
	<td class="label">E-Mail:</td>
    <td><?php echo $customer->email;?></td>
</tr>
</tbody>
</table>
<br />
<?php 
	if (Forms::isAllowed(FORM_CUSTOMER_EDIT)){
		$params = array("customer"=>"$customerid");
		echo "<a href='".Forms::getLink(FORM_CUSTOMER_EDIT, $params)."' id='edit'>Editar Infomaci&oacute;n</a>";	
	}
}
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#edit').button({
        icons: {primary: 'ui-icon-pencil'}
	})
})
</script>