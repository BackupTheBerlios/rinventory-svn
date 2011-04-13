<?php 
require_once 'inc/class.session.php';

$session = Session::getInstance();

if ($session->logged_in){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="img/favicon.ico"/>
<title>Sistema de Inventarios </title>
<link rel="stylesheet" type="text/css" href="css/reset-fonts-grids.css"/>
<link rel="stylesheet" type="text/css" href="css/template_css.css"/>
<link rel="stylesheet" type="text/css" href="css/admin_login.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.11.custom.css"/> 
<script type="text/javascript" src="js/json2.js"></script>
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.11.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/cms.javascript.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	$('.sf-menu').superfish();
});
</script>
</head>
<body>
	<div id="doc3" class="yui-t7"> 
		<div id="hd">
			<div id="header">
				<div>&nbsp;<img src="img/sweb/logo.png"/></div>
				<div id="nav_bar">
					<ul id="menu_bar" class="sf-menu">
						<li><a href="#">Compras</a>
							<ul>
								<li><a href="index.php?pages=purchase_new">Nuevo</a></li>
								<li><a href="index.php?pages=purchase_list">Listado</a></li>
								<li><a href="index.php?pages=purchase_payable">Por Pagar</a></li>
							</ul>
						</li>
						<li><a href="index.php?pages=inventario_list">Inventario</a></li>
						<li><a href="index.php?pages=almacen_list">Almacen</a></li>
						<li><a href="index.php?pages=traspaso_new">Traspasos</a></li>
						<?php if ($session->userlevel >= ADMIN_LEVEL) { ?>
						<li><a href="#">Usuario</a>
							<ul>
							<li><a href="index.php?pages=user_new">Nuevo</a></li>
							<li><a href="index.php?pages=user_list">Lista</a></li>
							</ul>
						</li>
						<?php }?>
						<li><a href="index.php?pages=cliente_list">Clientes</a></li>
						<li><a href="index.php?pages=venta_new">Ventas</a></li>
						<li><a href="process_login.php">Salir</a></li>
					</ul>
				</div>
			</div>
		</div> 
		<div id="bd"> 
			<div class="yui-g">
				<div id="mainwrapper">
<?php 
}
else { 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="img/favicon.ico"/>
<title>Sistema de Inventarios </title>
<link rel="stylesheet" type="text/css" href="css/reset-fonts-grids.css"/>
<link rel="stylesheet" type="text/css" href="css/admin_login.css" media="screen" />
<script type="text/javascript" src="js/cms.javascript.js"></script>
</head>
<body>
<div id="doc3" class="yui-t7">
	<div id="hd">&nbsp;</div>
	<div id="bd">
		<div class="yui-g">
			<div id="mainwrapper">
<?php 
}
?>