<p class="form-title">Almacen</p>
<?php
require 'inc/class.store.php';
require_once 'inc/class.log.php';

$storeid = isset($_GET['store']) ? $_GET['store'] : "";
$log = Log::getInstance();
$store = new Store();

if (!$storeid || !$store->read($storeid)){
	$log->addError(INFORMATION_UNAVAILABLE);
}

include 'inc/widget/error.php';
?>

<table class="form">
<tbody>
<tr>
	<td class="label">Nombre:</td>
	<td><?php echo $store->name;?></td>
</tr>
<tr>
	<td class="label">Nombre de Contacto:</td>
	<td><?php echo $store->contact;?></td>
</tr>
<tr>
	<td class="label">Tel&eacute;fono:</td>
	<td><?php echo $store->phone;?></td>
</tr>
<tr>
	<td class="label">Activo:</td>
	<td><?php echo $store->active == 1 ? ACTIVE_ON : ACTIVE_OFF;?></td>
</tr>
<tr>
	<td class="label">Direcci&oacute;n:</td>
	<td><?php echo $store->address;?></td>
</tr>
<tr>
	<td class="label">Fax:</td>
	<td><?php echo $store->fax;?></td>
</tr>
<tr>
	<td class="label">E-Mail:</td>
    <td><?php echo $store->email;?></td>
</tr>
<tr>
	<td class="label">Descripci&oacute;n</td>
	<td><?php echo $store->description;?></td>
</tr>
</tbody>
</table>
