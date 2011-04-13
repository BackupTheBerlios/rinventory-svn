<style>
.st_tbcss,.st_tdcss,.st_divcss,.st_ftcss{border:none;padding:0px;margin:0px}
A.st_acss,A.st_acss:link,A.st_acss:visited,A.st_acss:active,A.st_acss:hover{background-color:transparent;font-style:normal;border:none}
</style><font id="st_gl0"></font><font id="st_gl1"></font><font id="st_gl2"></font><font id="st_gl3"></font><font id="st_gl4"></font><font id="st_gl5"></font><font id="st_gl6"></font><font id="st_gl7"></font><font id="st_gl8"></font><font id="st_gl9"></font>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="menubar">
  <tbody><tr>
    <td>	<script id="Sothink Widgets:top_menu.inc.pgt" type="text/javascript" language="JavaScript1.2">
  </script>
    </td>
    <td align="right"><strong><a href="http://localhost/trunk/std/index.php?option=logout">Salir</a></strong> &nbsp;&nbsp;&nbsp;</td>
  </tr>
</tbody></table>
<!-- end top_menu_blank.inc.htm -->
	<!-- start toolbar.inc.htm -->


<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">


  <tbody>


    <tr>


      <td class="menudottedline" width="40%"><div class="pathway"><a href="http://localhost/trunk/std/index.php" class="headerNavigation">Panel de Control</a> » <a href="http://localhost/trunk/std/index.php?pages=cliente_list" class="headerNavigation">Cliente</a></div></td>


      <td class="menudottedline" align="right"><table id="toolbar" border="0" cellpadding="0" cellspacing="0">


          <tbody>


            <tr align="center" valign="middle">


			 <!-- start icons_toolbar_edit.inc.htm -->
<td>  
  <a class="toolbar" href="javascript:showMainMenu();if ($F('name')==''){alert('Ingrese el Nombre');} else if ($F('apellidos')==''){alert('Ingrese el(los) Apellidos');} else if($F('ci')==''){alert('Por favor ingrese el Documento de Identidad');} else if ($F('ci')==''){alert('Ingrese el Carnet de Identidad');} else{ submitbutton('save');}" onClick=""> <img src="img/sweb/save_f2.png" alt="Activo" name="active" align="middle" border="0"> <br> Guardar </a>
</td>
<td>&nbsp;</td>

<td><a class="toolbar" href="javascript: alert('new')" onClick=""> <img src="img/sweb/apply_f2.png" alt="Inactivo" name="inactivate" align="middle" border="0"> <br>
  Aplicar</a> </td> 
<td>&nbsp;</td>
  
<td>
<a class="toolbar" href="javascript:showMainMenu();submitbutton('cancel');" onClick=""> <img src="img/sweb/cancel_f2.png" alt="Cancelar" name="new" align="middle" border="0"> <br>
  Cancelar</a>
</td>
<td>&nbsp;</td>
<!-- end icons_toolbar_edit.inc.htm -->




            </tr>


          </tbody>


        </table></td>


    </tr>


  </tbody>


</table>


<!-- end toolbar.inc.htm -->	<!-- start company.inc.htm -->

<div class="centermain" align="center">
  <div class="main">
    <!-- start form_users_edit.inc.htm -->
<table class="adminheading">
  <tbody>
    <tr>
      <th class="categories"><script language="javascript" type="text/javascript"> od_displayImage('logo_{USER}', 'img/sweb/user',48,48 ,'icon-png','{USER}');</script>
      <img src="img/sweb/user.png" width="48" height="48" name="logo_{USER}" border="0" class="icon-png" alt="{USER}">
        Informaci&oacute;n del Cliente</th>
    </tr>
  </tbody>
</table>
<form action="index.php?pages=cliente" method="post" name="adminForm" enctype="multipart/form-data">
  <table class="adminform">
    <!--DWLayoutTable-->
    <tbody>
      <tr>
        <th colspan="3">Formulario de Registro</th>
      </tr>
	  <?
	   //require 'inc/conexion.php';
	  
	    $idalm=$_GET['id'];
		
	    $slc="selected='selected'";
		$idalm=$_GET['id'];
        $con=new Conexion();
	    $link=$con->conectar("dvdstore_on");
		
	    $res=mysql_query("Select *from dvd_cliente where id='".$idalm."'");
		$row=mysql_fetch_assoc($res);   
		
	 ?>
	  <tr>
	    <td nowrap="nowrap"><div align="right">Nombre:</div></td>
	    <td><input name="name" type="text" class="text_area" id="name" value="<? echo $row['name'];?>" size="60">
            <span class="obligatorio">*</span> </td>
	  </tr>
	  <tr>
	    <td nowrap="nowrap"><div align="right">Apellidos:</div></td>
	    <td><input name="apellidos" type="text" class="text_area" id="apellidos" value="<? echo $row['ape'];?>" size="60">
            <span class="obligatorio">*</span> </td>
	  </tr>
	    
          <tr>
            <td nowrap="nowrap"><div align="right">C.I.:</div></td>
            <td><input name="ci" type="text" class="text_area" id="ci" value="<? echo $row['ci'];?>" size="25">
              <span class="obligatorio">*</span></td>
          </tr>
		
       
      <tr>
        <td nowrap="nowrap" width="162"><div align="right">Direcci&oacute;n:</div></td>
        <td><input name="address" type="text" class="text_area" id="address" value="<? echo $row['address'];?>" size="60">        </td>
      </tr>
      <tr>
        <td nowrap="nowrap" width="162"><div align="right">Tel&eacute;fono:</div></td>
        <td><input name="phone" type="text" class="text_area" id="phone" value="<? echo $row['phone'];?>" size="60">        </td>
      </tr>     
      <tr>
        <td nowrap="nowrap" width="162"><div align="right">Celular:</div></td>
        <td><input name="cell" type="text" class="text_area" id="cell" value="<? echo $row['cell'];?>" size="60">        </td>
      </tr>  	 
	 
      <tr>
        <td width="162" valign="top" nowrap="nowrap"><div align="right">Imagen:</div></td>
        <td colspan="2"><input name="upload" type="file" class="text_area" id="upload" size="60">
          &nbsp;&nbsp;&nbsp;&nbsp;Tama&ntilde;o Max : 10M</td>
      </tr>
      <tr>
        <td colspan="3"><br>
          <input name="option" value="{FORM_OPTION}" type="hidden">
	  <input name="old_passwd" type="hidden" id="old_passwd" value="">
          <input name="section" value="{FORM_SECTION}" type="hidden">
          <input name="task" value="" type="hidden">
          <input name="id" type="hidden" id="id" value="<? echo $row['id'];?>">
          <input name="hw" type="hidden" id="hw" value="modify">
          <input name="hidemainmenu" value="{FORM_HIDE_MAIN_MENU}" type="hidden"></td>
      </tr>
    </tbody>
  </table>
  <? mysql_close($link); ?>
</form>
<!-- end form_users_edit.inc.htm -->
  </div>
</div>

