<style>
.st_tbcss,.st_tdcss,.st_divcss,.st_ftcss{border:none;padding:0px;margin:0px}
A.st_acss,A.st_acss:link,A.st_acss:visited,A.st_acss:active,A.st_acss:hover{background-color:transparent;font-style:normal;border:none}
</style><font id="st_gl0"></font><font id="st_gl1"></font><font id="st_gl2"></font><font id="st_gl3"></font><font id="st_gl4"></font><font id="st_gl5"></font><font id="st_gl6"></font><font id="st_gl7"></font><font id="st_gl8"></font><font id="st_gl9"></font>

<!-- end top_menu.inc.htm -->
<!-- start toolbar.inc.htm -->

<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td class="menudottedline" width="40%">
		<div class="pathway">
			<a href="./index.php?option=home" class="headerNavigation">Panel de Control</a> <?php  echo SB_BREADCRUMB;?> <a href="./index.php?pages=usuario_list" class="headerNavigation">Usuarios</a>
		</div>
	</td>
	<td class="menudottedline" align="right">
		<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
		<tr align="center" valign="middle">
			<!-- start icons_toolbar.inc.htm -->
			<td>&nbsp;</td>
			<td>
				<a class="toolbar" href="javascript:hideMainMenu();submitbutton('new');" onclick=""><img src="img/sweb/new_f2.png" alt="Nuevo" name="new" align="middle" border="0"><br/>
  				Nuevo</a>
  			</td>
			<td>&nbsp;</td>
			<td>
				<a class="toolbar" href="javascript: alert('No activo en el Demo')" onclick=""><img src="img/sweb/delete_f2.png" alt="Borrar" name="delete" align="middle" border="0"><br>
  				Borrar</a>
  			</td>
			<td>&nbsp;</td>
			<!-- end icons_toolbar.inc.htm -->
		</tr>
		</table>
	</td>
</tr>
</table>

<!-- end toolbar.inc.htm -->
<!-- start company.inc.htm -->

<div class="centermain" align="center">
	<div class="main">
		<!-- start form_users_list.inc.htm -->
		<table class="adminheading">
		<tr>
			<th class="categories">
				<img src="img/sweb/user.png" width="48" height="48" name="logo_{USER}" border="0" class="icon-png" alt="{SECCIONALES}">
				Usuarios <span id="filter"></span>
			</th>
			<td align="right">
				<form action="./index.php?option=com_users#" method="post">
					<div align="center">
						<input class="inputbox" type="text" name="searchword" size="25" value="- Buscar -" onBlur="if(this.value==&#39;&#39;) this.value=&#39;- Buscar -&#39;;" onFocus="if(this.value==&#39;- Buscar -&#39;) this.value=&#39;&#39;;">
						<input type="hidden" name="option" value="search">
					</div>
				</form>
			</td>
		</tr>
		</table>

		<form action="./index.php?pages=usuario_new" method="post" name="adminForm">
			<table class="adminlist">
			<tr>
				<th align="center" width="5">&nbsp;  </th>
				<th width="20"> <input name="toggle" value="" onclick="checkAll(7);" type="checkbox"></th>
				<th class="title">
					<a href="javascript:listOrder('1');void(0);">Nombre </a>
					<img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/>
				</th>
				<th width="70">
					<a href="javascript: listOrder('2');void(0);">Activo </a>
					<img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/>
				</th>
				<th align="left">
					<a href="javascript: listOrder('3');void(0);">Departamento </a>
					<img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/>
				</th>
				<th align="left">
					<a href="javascript: listOrder('4');void(0);">E-Mail </a>
					<img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar"/>
				</th>
				<th nowrap="nowrap">
					<a href="javascript: listOrder('5');void(0);">Tel&eacute;fono </a>
					<img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
				</th>
				<th nowrap="nowrap"> &Uacute;ltima Visita </th>
<?php
	$res = $db->query("SELECT id,name,active,link_departament,email,phone,last_update FROM ". TBL_USER);
	$sw = 0;
	$cnt = 1;
	
	while($row = $db->getRow($res, 0)) {
		$sim = "tick.png";

		if($row['active'] == 0)
			$sim = "publish_x.png";  
?>
			</tr>
			<tr class="row<?php echo $sw;?>">
				<td align="center">&nbsp;  </td>
				<td><input id="cb0" name="cid[]" value="167296cc5b093a7dc22f315baee163be" onclick="isChecked(this.checked);" type="checkbox"> </td>
				<td><a href="./index.php?pages=modify_usr&id=<?php echo $row['id']; ?>"><?php echo $row['name'];?></a></td>
				<td align="center"> <img src="img/sweb/<?php echo $sim;?>" alt="Activo" border="0"> </td>
				<td align="left"><?php echo $row['link_departament'];?></td>
				<td align="left"><?php echo $row['email']; ?></td>
				<td align="center"><?php echo $row['phone'];?></td>
				<td align="center"><?php echo $row['last_update'];?></td>
			</tr>
<?php 
		$sw = $sw == 1 ? 0 : 1;
		$cnt++;        
	}
?>
			</table>
			<input name="option" value="com_users" type="hidden">
			<input name="section" value="" type="hidden">
			<input name="task" value="" type="hidden">
			<input name="chosen" value="" type="hidden">
			<input name="act" value="" type="hidden">
			<input name="boxchecked" value="0" type="hidden">
			<input name="type" value="list" type="hidden">
			<input name="hidemainmenu" value="0" type="hidden">
			<input name="order" type="hidden" id="order" value="{FORM_ORDER_BY}">
			<input name="flag_order" type="hidden" id="flag_order" value="0">
		</form>
		<!-- end form_users_list.inc.htm -->
  </div>
</div>
