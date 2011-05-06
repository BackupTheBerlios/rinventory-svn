<p class="form-title">Listado de Clientes</p>
<?php
require 'inc/class.customer.php';
require 'inc/class.formatter.php';

$sortBy = isset($_GET['sort_by']) ? $_GET['sort_by'] : "";
$sortOrder = isset($_GET['sort_dir']) ? strtolower($_GET['sort_dir']) : "";

if (!$sortBy || !Customer::isField($sortBy))
	$sortBy = "name";

if(!$sortOrder)
	$sortOrder = "a";
	
$customers = Customer::getAll($sortBy, $sortOrder == "d" ? "DESC" : "ASC");  
?>
<table class="default">
<thead>
<tr>
	<th style="width:27em"><a href="<?php echo Forms::getLink(FORM_CUSTOMER_LIST, Forms::getSort($sortBy, Customer::fieldName("name"), $sortOrder));?>">Nombre</a></th>
	<th style="width:8em"><a href="<?php echo Forms::getLink(FORM_CUSTOMER_LIST, Forms::getSort($sortBy, Customer::fieldName("nit"), $sortOrder));?>">NIT</a></th>
	<th><a href="<?php echo Forms::getLink(FORM_CUSTOMER_LIST, Forms::getSort($sortBy, Customer::fieldName("phone"), $sortOrder));?>">Tel&eacute;fono</a></th>
	<th><a href="<?php echo Forms::getLink(FORM_CUSTOMER_LIST, Forms::getSort($sortBy, Customer::fieldName("email"), $sortOrder));?>">Email</a></th>
	<th><a href="<?php echo Forms::getLink(FORM_CUSTOMER_LIST, Forms::getSort($sortBy, Customer::fieldName("active"), $sortOrder));?>">Activo</a></th>
	<th style="width:20em">Direcci&oacute;n</th>
	<th colspan="2">&nbsp;</th>
</tr>
</thead>
<tbody>		
<?php

foreach ($customers as $customer){
	$params = array("customer" => $customer->id);  
?>
	<tr>
		<td><?php echo $customer->name;?></td>
		<td><?php echo $customer->nit;?></td>
		<td class="date"><?php echo $customer->phone;?></td>
		<td><?php echo $customer->email;?></td>
		<td style="padding-left:1em"><?php echo $customer->active == 1 ? ICON_ACTIVE : ICON_INACTIVE;?></td>
		<td><?php echo Formatter::text($customer->address); ?></td>
		<td class="ui-state-default"><a href="<?php echo Forms::getLink(FORM_CUSTOMER_DETAIL, $params);?>"><?php echo ICON_ZOOMIN;?></a></td>
		<td class="ui-state-default"><a href="<?php echo Forms::getLink(FORM_CUSTOMER_EDIT, $params);?>"><?php echo ICON_PENCIL;?></a></td>
	</tr>
<?php         
} 
?>     	  
</tbody>
</table>	  