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
if($form->num_errors > 0){
   echo "<font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
}

?>

<div id="ctr" align="center">
  <div class="login">
    <div class="login-form"> <img src="img/sweb/login.gif" alt="Acceder" width="174" height="33"/>
      <form action="process_login.php" method="post" name="login" id="login">
        <div class="form-block">
          <div class="inputlabel">Nombre de Usuario</div>
          <div>
            <input name="username" type="text" class="inputbox" id="username" value="" size="32"/>
          </div>
          <div class="inputlabel">Contrase&ntilde;a</div>
          <div>
            <input name="passwd" type="password" class="inputbox" id="passwd" value="" size="32"/>
          </div>
		  <div align="left">
            <input name="submit" class="button" value="Entrar" type="submit"/>
          &nbsp;&nbsp; Ingresar como <a href="index.php?option=home"><span style="color:#0033CC">invitado</span></a></div>
        </div>
        <input type="hidden" name="challenge" value="&lt;?php print $challenge ?&gt;"/>
        <input type="hidden" name="response" value=""/>
        <input name="user" type="hidden" id="user" value=""/>
		<input type="hidden" id="pwd" name="pwd" value=""/>
		<input type="hidden" name="sub_login" value="1"/>
      </form>
    </div>
    <div class="login-text">
      <div class="ctr"><img src="img/sweb/security.png" alt="seguridad" height="64" width="200"/></div>
      <p>Bienvenido</p>
      <p>Tienes que usar un Nombre de usuario y Contrase&ntilde;a validos para acceder al sistema de inventarios x</p>
    </div>
    <div class="clr"></div>
  </div>
</div>

				</div>
			</div> 
		</div> 
		<div id="ft"><p>Derechos Reservados 2011</p></div> 
	</div>
<script type="text/javascript">
// Activate the appropriate input form field.
if (document.login.username.value == '')
	document.login.username.focus();
else
	document.login.password.focus();
</script>
</body>
</html>

