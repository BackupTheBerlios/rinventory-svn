<?php 
require_once 'inc/class.session.php';

$session = Session::getInstance();

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml">';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo '<link rel="shortcut icon" href="img/favicon.ico"/>';
echo '<title>Sistema de Inventarios</title>';
echo '<link rel="stylesheet" type="text/css" href="css/reset-fonts-grids.css"/>';
echo '<link rel="stylesheet" type="text/css" href="css/template_css.css"/>';
echo '<link rel="stylesheet" type="text/css" href="css/admin_login.css" media="screen" />';
echo '<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.11.custom.css"/>'; 
echo '<script type="text/javascript" src="js/json2.js"></script>';
echo '<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>';
echo '<script type="text/javascript" src="js/jquery-ui-1.8.11.min.js"></script>';
echo '<script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script>';
echo '<script type="text/javascript" src="js/general.js"></script>';
echo '<script type="text/javascript" src="js/cms.javascript.js"></script>';
echo '<script type="text/javascript">';
echo 'jQuery(document).ready(function(){jQuery(\'.sf-menu\').superfish();});';
echo '</script>';
echo '</head>'; 
echo '<body>';
echo '<div id="doc3" class="yui-t7">';
?>
<div id="hd">
	<div id="header">
		<div>&nbsp;<img src="img/sweb/logo.png"/> &nbsp;Bienvenido: <?php echo $session->userinfo['firstname']. " ".$session->userinfo['lastname'];?></div>
		<div id="nav_bar">
			<ul id="menu_bar" class="sf-menu">
				<li><a href="index.php">Inicio</a></li>
				<li><a href="#">Compras</a>
					<ul>
						<?php if (Forms::isAllowed(FORM_PURCHASE_NEW)){ ?>
						<li><a href="<?php echo Forms::getLink(FORM_PURCHASE_NEW)?>">Nuevo</a></li>
						<?php } ?>
						<?php if (Forms::isAllowed(FORM_PURCHASE_LIST)){ ?>
						<li><a href="<?php echo Forms::getLink(FORM_PURCHASE_LIST)?>">Listado</a></li>
						<?php } ?>
						<?php if (Forms::isAllowed(FORM_PURCHASE_PAYABLE)){ ?>
						<li><a href="<?php echo Forms::getLink(FORM_PURCHASE_PAYABLE)?>">Por Pagar</a></li>
						<?php } ?>
					</ul>
				</li>
				<li><a href="#">Inventario</a>
					<ul>
						<li><a href="index.php?pages=inventario_new">Nuevo Producto</a></li>
						<li><a href="index.php?pages=inventario_list">Listado</a></li>
					</ul>
				</li>
				<li><a href="#">Almacen</a>
					<ul>
					<li><a href="index.php?pages=store_edit&store=new">Nuevo</a></li>
					<li><a href="index.php?pages=store_list">Listado</a></li>
					</ul>
				</li>
				<li><a href="index.php?pages=traspaso_new">Traspasos</a></li>
				<li><a href="#">Usuario</a>
					<ul>
					<?php if (Forms::isAllowed(FORM_USER_NEW)){ ?>
					<li><a href="<?php echo Forms::getLink(FORM_USER_NEW);?>">Nuevo</a></li>
					<?php } ?>
					<?php if (Forms::isAllowed(FORM_USER_LIST)){ ?>
					<li><a href="<?php echo Forms::getLink(FORM_USER_LIST);?>">Lista</a></li>
					<?php } ?>
					</ul>
				</li>
				<li><a href="#">Clientes</a>
					<ul>
					<?php if (Forms::isAllowed(FORM_CUSTOMER_NEW)){?>
						<li><a href="<?php echo Forms::getLink(FORM_CUSTOMER_NEW);?>">Nuevo</a></li>
					<?php }?>
					<?php if (Forms::isAllowed(FORM_CUSTOMER_LIST)){?>
						<li><a href="<?php echo Forms::getLink(FORM_CUSTOMER_LIST);?>">Listado</a></li>
					<?php }?>
					</ul>
				</li>
				<li><a href="#">Ventas</a>
					<ul>
					<li><a href="index.php?pages=sell_new">Nuevo</a></li>
					<li><a href="index.php?pages=sell_list">Listado</a></li>
					<li><a href="index.php?pages=sell_outstanding">Por Cobrar</a></li>
					</ul>
				</li>
				<li><a href="process_login.php">Salir</a></li>
			</ul>
		</div>
	</div>
</div>
<?php
echo '<div id="bd"><div class="yui-g"><div id="mainwrapper">'; 
?> 
		 
			
				