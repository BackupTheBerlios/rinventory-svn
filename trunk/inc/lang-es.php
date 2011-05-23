<?php
define('ACTIVE_ON', '<span class="ui-icon ui-icon-check"></span>');
define('ACTIVE_OFF', '<span class="ui-icon ui-icon-closethick"></span>');
define('ICON_ACTIVE', '<span class="ui-icon ui-icon-check"></span>');
define('ICON_INACTIVE', '<span class="ui-icon ui-icon-closethick"></span>');
define('ICON_INFO', '<span class="ui-icon ui-icon-info"></span>');
define('ICON_PENCIL', '<span class="ui-icon ui-icon-pencil"></span>');
define('ICON_ZOOMIN', '<span class="ui-icon ui-icon-zoomin"></span>');
define('ICON_ALERT', '<span class="ui-icon ui-icon-alert"></span>');
define('INFORMATION_UNAVAILABLE', 'Infomaci&oacute;n no disponible.');
define('ERROR_TITLE', '&iexcl;ERROR...!');
define('ALERT_TITLE', 'Atenci&oacute;n');
define('SB_BREADCRUMB', '&raquo;');
define('SB_CURRENCY', 'Bs. ');
define('ERROR_BD_QUERY', 'Error BD-001.');

$PURCHASE_STATUS = array(
	PURCHASE_STATUS_PENDING => 'Pendiente',
	PURCHASE_STATUS_INTRANSIT => 'En Transito', 
	PURCHASE_STATUS_DELIVERED => 'Entregado',
	PURCHASE_STATUS_CANCELED => 'Cancelado');
$PAYMENT_TYPE = array(
	PAYMENT_TYPE_CASH => 'Contado',
	PAYMENT_TYPE_CREDIT => 'Credito');
$UNIT_TYPE = array(
	UNIT_TYPE_BOX => 'Caja',
	UNIT_TYPE_PACKAGE => 'Paquete',
	UNIT_TYPE_UNIT => 'Unidad');
$ROLE_LEVEL = array(
	ADMIN_LEVEL => "Administrador",
	CASH_LEVEL => "Caja",	
	USER_LEVEL => "Normal",
	SELLS_LEVEL => "Venta",
	);
?>