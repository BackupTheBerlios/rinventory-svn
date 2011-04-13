<style>
.st_tbcss,.st_tdcss,.st_divcss,.st_ftcss{border:none;padding:0px;margin:0px}
A.st_acss,A.st_acss:link,A.st_acss:visited,A.st_acss:active,A.st_acss:hover{background-color:transparent;font-style:normal;border:none}
</style><font id="st_gl0"></font><font id="st_gl1"></font><font id="st_gl2"></font><font id="st_gl3"></font><font id="st_gl4"></font><font id="st_gl5"></font><font id="st_gl6"></font><font id="st_gl7"></font><font id="st_gl8"></font><font id="st_gl9"></font>

<!-- end top_menu_blank.inc.htm -->
<!-- start toolbar.inc.htm -->

<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
	<td class="menudottedline" width="40%">
		<div class="pathway"><a href="./index.php?option=home" class="headerNavigation">Panel de Control</a> <?php echo SB_BREADCRUMB;?> <a href="./index.php?pages=usuario_list" class="headerNavigation">Usuarios</a></div>
	</td>
	<td class="menudottedline" align="right">
		<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
		<tr align="center" valign="middle">
		<!-- start icons_toolbar_edit.inc.htm -->
			<td>  
				<a class="toolbar" href="javascript:showMainMenu();if ($F('name')==''){alert('Ingrese el Nombre');} else if ($F('apellidos')==''){alert('Ingrese el(los) Apellidos');} else if($F('login')==''){alert('Por favor ingrese el Login de usuario');} else if ($F('passwd')!=$F('passwd2')){alert('Las contrase&ntilde;as no coinciden');}else if ($F('ci')==''){alert('Ingrese el Carnet de Identidad');} else{ submitbutton('save');}" onClick=""> <img src="img/sweb/save_f2.png" alt="Activo" name="active" align="middle" border="0"> <br> Guardar </a>
			</td>
			<td>&nbsp;</td>
			<td><a class="toolbar" href="javascript: alert('new')" onClick=""> <img src="img/sweb/apply_f2.png" alt="Inactivo" name="inactivate" align="middle" border="0"> <br> Aplicar</a></td> 
			<td>&nbsp;</td>
			<td>
				<a class="toolbar" href="javascript:showMainMenu();submitbutton('cancel');" onClick=""> <img src="img/sweb/cancel_f2.png" alt="Cancelar" name="new" align="middle" border="0"> <br> Cancelar</a>
			</td>
			<td>&nbsp;</td>
		<!-- end icons_toolbar_edit.inc.htm -->
		</tr>
		</table>
	</td>
</tr>
</tbody>
</table>

<!-- end toolbar.inc.htm -->
<!-- start company.inc.htm -->

<div class="centermain" align="center">
	<div class="main">
	<!-- start form_users_edit.inc.htm -->
		<table class="adminheading">
		<tr>
			<th class="categories"><img src="img/sweb/user.png" width="48" height="48" name="logo_{USER}" border="0" class="icon-png" alt="{USER}"/> Informaci&oacute;n de Usuario</th>
		</tr>
		</table>
		
		<form action="index.php?pages=usuario" method="post" name="adminForm" enctype="multipart/form-data">
			<table class="adminform">
			<!--DWLayoutTable-->
			<tbody>
			<tr>
				<th colspan="3">Formulario de Registro</th>
			</tr>
<?php

$slc = "selected='selected'";
$idalm = $_GET['id'];
$res = $db->query("SELECT * FROM ". TBL_USER ." WHERE id='$idalm'");
$row = $db->getRow($res, 0);   
$chek = "";

if($row['active']==1)
	$chek="checked='checked'"; 
?>
			<tr>
				<td nowrap="nowrap"><div align="right">Nombre:</div></td>
				<td><input name="name" type="text" class="text_area" id="name" value="<? echo $row['name'];?>" size="60"> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td nowrap="nowrap"><div align="right">Apellidos:</div></td>
				<td><input name="apellidos" type="text" class="text_area" id="apellidos" value="<? echo $row['name']; ?>" size="60"> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="162"><div align="right">Login:</div></td>
				<td><input name="login" type="text" class="text_area" id="login" value="<? echo $row['username']; ?>" size="25"> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td width="150"><div align="right">Contrase&ntilde;a:</div></td>
				<td><input name="passwd" type="password" class="text_area" id="passwd" value="" size="25"> <span class="obligatorio">*</span>  </td>
			</tr>
			<tr>
				<td><div align="right">Verificar Contrase&ntilde;a:</div></td>
				<td><input name="passwd2" type="password" class="text_area" id="passwd2" value="" size="25"> <span class="obligatorio">*</span> </td>
			</tr>	           
			<tr>
				<td nowrap="nowrap"><div align="right">C.I.::</div></td>
				<td><input name="ci" type="text" class="text_area" id="ci" value="<? echo $row['CI']; ?>" size="25"> <span class="obligatorio">*</span></td>
			</tr>
			<tr>
				<td nowrap="nowrap"><div align="right">Activo:</div></td>
				<td><input name="active"<? echo $chek; ?> type="checkbox" id="active" value="1"></td>
				<td rowspan="12" valign="top"></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="162"><div align="right">Tipo de Usuario:</div></td>
				<td>
					<select name="roll" id="roll" style="width:320px;" class="text_area">
					<option value=""></option>
					<option value="consulta">Consulta</option>
					<option value="Aux.de Almacen">Aux. de Almacen</option>
					<option value="almacenista">Almacenista</option>
					<option value="compras">Compras</option>
					<option value="recursos humanos">Recursos Humanos</option>
					<option value="coordinador">Coordinador</option>
					<option value="residente">Administrador</option>
					<option value="superadmin">SuperAdmin</option>
					</select>
				</td>
			</tr>                  
			<tr>
				<td nowrap="nowrap" width="162"><div align="right">Direcci&oacute;n:</div></td>
				<td><input name="address" type="text" class="text_area" id="address" value="<? echo $row['address']?>" size="60"> </td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="162"><div align="right">Tel&eacute;fono:</div></td>
				<td><input name="phone" type="text" class="text_area" id="phone" value="<? echo $row['phone']?>" size="60"> </td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="162"><div align="right">Departamento:</div></td>
				<td>
					<select name="company" id="company" style="width:320px;" class="text_area">
					<option value="">&nbsp;</option>
<?php

$res = $db->query("SELECT name FROM ". TBL_DEPARTMENT);
while($rowc =  $db->getRow($res, 0)) {
?>
					<option value="<? echo $rowc['name'];?>"<?php echo $rowc['name']==$row['link_departament'] ? " selected='selected'" : "";?>><? echo $rowc['name']; ?></option>
<?php 
}
?>
				   </select>
				</td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="162"><div align="right">E-Mail:</div></td>
				<td><input name="email" type="text" class="text_area" id="email" value="<?php echo $row['email']?>" size="60"></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="162"><div align="right">Fecha de Registro:</div></td>
				<td><?php echo $row['hw_added'];?></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="162"><div align="right">&Uacute;ltima Modificaci&oacute;n:</div></td>
				<td><?php echo $row['last_update']?></td>
			</tr>
			<tr>
				<td width="162" valign="top" nowrap="nowrap"><div align="right">Imagen:</div></td>
				<td colspan="2"><input name="upload" type="file" class="text_area" id="upload" size="60">&nbsp;&nbsp;&nbsp;&nbsp;Tama&ntilde;o Max : 10M</td>
			</tr>
			<tr>
				<td colspan="3"><br/>
					<input name="option" value="{FORM_OPTION}" type="hidden"/>
					<input name="old_passwd" type="hidden" id="old_passwd" value=""/>
					<input name="section" value="{FORM_SECTION}" type="hidden"/>
					<input name="task" value="" type="hidden"/>
					<input name="id" type="hidden" id="id" value="<? echo $row['id'];?>"/>
					<input name="hw" type="hidden" id="hw" value="modify"/>
					<input name="hidemainmenu" value="{FORM_HIDE_MAIN_MENU}" type="hidden"/>
				</td>
      	</tr>
			</tbody>
			</table>
		</form>
<!-- end form_users_edit.inc.htm -->
	</div>
</div>
