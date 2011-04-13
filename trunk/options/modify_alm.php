<style>
.st_tbcss,.st_tdcss,.st_divcss,.st_ftcss{border:none;padding:0px;margin:0px}
A.st_acss,A.st_acss:link,A.st_acss:visited,A.st_acss:active,A.st_acss:hover{background-color:transparent;font-style:normal;border:none}
</style><font id="st_gl0"></font><font id="st_gl1"></font><font id="st_gl2"></font><font id="st_gl3"></font><font id="st_gl4"></font><font id="st_gl5"></font><font id="st_gl6"></font><font id="st_gl7"></font><font id="st_gl8"></font><font id="st_gl9"></font>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="menubar">
  <tbody><tr>
    <td>
	<script id="Sothink Widgets:top_menu.inc.pgt" type="text/javascript" language="JavaScript1.2">

  </script>
    </td>
    <td align="right"><strong><a href="http://localhost/trunk/std/index.php?option=logout">Salir</a></strong>&nbsp;&nbsp;&nbsp;</td>
  </tr>
</tbody></table>
<!-- end top_menu.inc.htm -->
	<!-- start toolbar.inc.htm -->


<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">


  <tbody>


    <tr>


      <td class="menudottedline" width="40%"><div class="pathway"><a href="http://localhost/trunk/std/index.php?option=home" class="headerNavigation">Panel de Control</a> » <a href="http://localhost/trunk/std/index.php?pages=almacen_list" class="headerNavigation">Almacen</a></div></td>


      <td class="menudottedline" align="right"><table id="toolbar" border="0" cellpadding="0" cellspacing="0">


          <tbody>


            <tr align="center" valign="middle">


			 <!-- start icons_toolbar_edit.inc.htm -->

	<td><a class="toolbar" href="javascript:showMainMenu();if($F('name')==''){alert('Por favor ingrese el Nombre del Departamento');} else if ($F('contact_name')==''){alert('Por favor Ingrese el Nombre del Contacto');} else if ($F('phone')==''){alert('Ingrese el Número Telefónico');} else{ submitbutton('save');}" onClick=""> <img src="img/sweb/save_f2.png" alt="Activo" name="active" align="middle" border="0"> <br>
  Guardar</a> </td>
<td>&nbsp;</td>

<td><a class="toolbar" href="javascript:if($F('name')==''){alert('Por favor ingrese el Nombre del Departamento');} else if ($F('contact_name')==''){alert('Por favor Ingrese el Nombre del Contacto');} else if ($F('phone')==''){alert('Ingrese el Número Telefónico');} else{ submitbutton('apply');}" onClick=""> <img src="img/sweb/apply_f2.png" alt="Inactivo" name="inactivate" align="middle" border="0"> <br>
  Aplicar</a> </td> 
<td>&nbsp;</td>

<td><a class="toolbar" href="javascript:showMainMenu();submitbutton('cancel');" onClick=""> <img src="img/sweb/cancel_f2.png" alt="Nuevo" name="new" align="middle" border="0"> <br>
  Cancelar</a> </td>

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
    <!-- start form_departamentos_edit.inc.htm -->
<script language="Javascript" src="js/overlib_mini.js"></script>
<link href="css/media.css" rel="stylesheet" type="text/css">
<table class="adminheading">
  <tbody>
    <tr>
      <th class="categories"><script language="javascript" type="text/javascript"> od_displayImage('logo_Departamentos', 'img/sweb/departamentos',48,48 ,'icon-png','Departamentos');</script><img src="img/sweb/departamentos.png" width="48" height="48" name="logo_Departamentos" border="0" class="icon-png" alt="Departamentos">
        Almacen</th>
    </tr>
  </tbody>
</table>
<form action="index.php?pages=almacen" method="post" name="adminForm" enctype="multipart/form-data">
  <table class="adminform">
    <!--DWLayoutTable-->
    <?php
	 //require 'inc/conexion.php';
	 $idalm=$_GET['id'];
	  
        $con=new Conexion();
	    $link=$con->conectar("dvdstore_on");
		
	    $res=mysql_query("Select *from dvd_departament where id='".$idalm."'");
		$row=mysql_fetch_assoc($res);
		
		 $chek="";
		  if($row['active']==1)
			 $chek="checked='checked'";  
       ?>
    <tbody>
      <tr>
        <th colspan="3">Detalles</th>
      </tr>
      <tr>
        <td nowrap="nowrap" width="250"><div align="right">Nombre:</div></td>
        <td><input name="name" type="text" class="text_area" id="name" value="<?php echo $row['name'];?>" size="60"> <span class="obligatorio">*</span>       </td>
		<td rowspan="8" valign="top"></td>
      </tr>
	  <tr>
        <td nowrap="nowrap" width="250"><div align="right">Nombre de Contacto:</div></td>
        <td><input name="contact_name" type="text" class="text_area" id="contact_name" value="<?php echo $row['contact_name'];?>" size="60">  <span class="obligatorio">*</span>      </td>
      </tr>
	  <tr>
        <td nowrap="nowrap" width="250"><div align="right">Teléfono:</div></td>
        <td><input name="phone" type="text" class="text_area" id="phone" value="<?php echo $row['phone'];?>" size="60">   <span class="obligatorio">*</span>     </td>
      </tr>
      <tr>
        <td nowrap="nowrap" width="250"><div align="right">Activo:</div></td>
        <td><input name="active" <?php echo $chek;?> type="checkbox" id="active" value="<?php echo $row['active']; ?>"></td>
      </tr>
      <tr>
        <td nowrap="nowrap" width="250"><div align="right">Dirección:</div></td>
        <td><input name="address" type="text" class="text_area" id="address" value="<?php echo $row['address'];?>" size="60">        </td>
      </tr>
      <tr>
        <td nowrap="nowrap" width="250"><div align="right">Fax:</div></td>
        <td><input name="fax" type="text" class="text_area" id="fax" value="<?php echo $row['fax'];?>" size="60">        </td>
      </tr>
      <tr>
        <td nowrap="nowrap" width="250"><div align="right">Sitio Web:</div></td>
        <td><input name="website" type="text" class="text_area" id="website" value="<?php echo $row['website'];?>" size="60">        </td>
     </tr>
      <tr>
        <td nowrap="nowrap" width="250"><div align="right">E-Mail:</div></td>
        <td><input name="email" type="text" class="text_area" id="email" value="<?php echo $row['email'];?>" size="60"> </td>
      </tr>
      <tr>
        <td width="250" valign="top" nowrap="nowrap"><div align="right">Imagen:</div></td>
        <td colspan="2"><input name="upload" type="file" class="text_area" id="upload" size="60">
          &nbsp;&nbsp;&nbsp;&nbsp;Tamaño Max : 10M</td>
      </tr>
      <tr>
        <td width="250" rowspan="2" valign="top" nowrap="nowrap"><div align="right">Observaciones: </div></td>
        <td width="445" height="1"></td>
        <td></td>
      </tr>
      <tr>
        <td valign="top"><div class="htmlarea">
            <textarea name="notes" cols="60" rows="7" class="text_area" id="Description"><?php echo $row['description'];?></textarea>
          </div></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="3"><br>
          <input name="option" value="com_departamentos" type="hidden">
          <input name="section" value="" type="hidden">
          <input name="task" value="" type="hidden">
          <input name="hw" type="hidden" id="hw" value="modify">
          <input name="idalm" type="hidden" id="idalm" value="<?php echo $row['id'];?>">
          <input name="hidemainmenu" value="0" type="hidden"></td>
      </tr>
    </tbody>
 <?php mysql_close($link); ?>
  </table>
</form>
<!-- end form_departamentos_edit.inc.htm -->

  </div>
</div>
