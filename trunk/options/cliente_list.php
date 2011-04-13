<style>
.st_tbcss,.st_tdcss,.st_divcss,.st_ftcss{border:none;padding:0px;margin:0px}
A.st_acss,A.st_acss:link,A.st_acss:visited,A.st_acss:active,A.st_acss:hover{background-color:transparent;font-style:normal;border:none}
</style><font id="st_gl0"></font><font id="st_gl1"></font><font id="st_gl2"></font><font id="st_gl3"></font><font id="st_gl4"></font><font id="st_gl5"></font><font id="st_gl6"></font><font id="st_gl7"></font><font id="st_gl8"></font><font id="st_gl9"></font>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="menubar">
  <tbody><tr>
    <td>
<script>
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


      <td class="menudottedline" width="40%"><div class="pathway"><a href="http://localhost/trunk/std/index.php?option=home" class="headerNavigation">Panel de Control</a> » <a href="img/sweb/usuario.htm" class="headerNavigation">Clientes</a></div></td>


      <td class="menudottedline" align="right"><table id="toolbar" border="0" cellpadding="0" cellspacing="0">


          <tbody>


            <tr align="center" valign="middle">


			 <!-- start icons_toolbar.inc.htm -->
  <td>&nbsp;</td>

<td><a class="toolbar" href="javascript:hideMainMenu();submitbutton('new');" onClick=""> <img src="img/sweb/new_f2.png" alt="Nuevo" name="new" align="middle" border="0"> <br>
  Nuevo</a> </td>
<td>&nbsp;</td>

<td><a class="toolbar" href="javascript: alert('No activo en el Demo')" onClick=""> <img src="img/sweb/delete_f2.png" alt="Borrar" name="delete" align="middle" border="0"> <br>
  Borrar</a> </td>

<td>&nbsp;</td>

<!-- end icons_toolbar.inc.htm -->


            </tr>


          </tbody>


        </table></td>


    </tr>


  </tbody>


</table>


<!-- end toolbar.inc.htm -->	<!-- start company.inc.htm -->

<div class="centermain" align="center">
  <div class="main">
    <!-- start form_users_list.inc.htm -->

<table class="adminheading">
  <tbody>
    <tr>
      <th class="categories"><script language="javascript" type="text/javascript"> od_displayImage('logo_{USER}', 'img/sweb/user',48,48 ,'icon-png','{SECCIONALES}');</script><img src="img/sweb/user.png" width="48" height="48" name="logo_{USER}" border="0" class="icon-png" alt="{SECCIONALES}">
        Clientes <span id="filter"></span></th>
      <td align="right"><form action="http://localhost/trunk/std/index.php?option=cliente" method="post">
          <div align="center">
            <input class="inputbox" type="text" name="searchword" size="25" value="- Buscar -" onBlur="if(this.value==&#39;&#39;) this.value=&#39;- Buscar -&#39;;" onFocus="if(this.value==&#39;- Buscar -&#39;) this.value=&#39;&#39;;">
            <input type="hidden" name="option" value="search">
          </div>
        </form></td>
    </tr>
  </tbody>
</table>
<form action="http://localhost/trunk/std/index.php?option=cliente" method="post" name="adminForm">
  
-      <table class="adminlist">
    <tbody>
      <tr>
        <th align="center" width="5">&nbsp;  </th>
        <th width="20"> <input name="toggle" value="" onClick="checkAll(7);" type="checkbox">
        </th>
        <th class="title"> <a href="javascript: listOrder('1');void(0);">Nombre </a>
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12 ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th width="70"> <a href="javascript: listOrder('2');void(0);">Activo </a>
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th align="left"> <a href="javascript: listOrder('3');void(0);">C.I. </a>
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th align="left"> <a href="javascript: listOrder('4');void(0);">Direcci&oacute;n </a>
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th nowrap="nowrap"> <a href="javascript: listOrder('5');void(0);">Teléfono </a>
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th nowrap="nowrap"> Celular</th>
		<?php //require 'inc/conexion.php'; 
		
		$con=new Conexion();
	    $link=$con->conectar("dvdstore_on");
	    $res=mysql_query("Select id,name,ape,ci,address,phone,cell from dvd_cliente");
		$sw=0; $cnt=1;
	    while($row=mysql_fetch_assoc($res))
	     {
		 $sim="tick.png";
			if($row['active']==0)
			 $sim="publish_x.png";  
		 ?>
      </tr><tr class="row<? echo $sw;?>">
        <td align="center">&nbsp;  </td>
        <td><input id="cb0" name="cid[]" value="167296cc5b093a7dc22f315baee163be" onClick="isChecked(this.checked);" type="checkbox"> </td>
        <td><a href="index.php?pages=modify_cln&id=<?php echo $row['id']; ?>"><?php echo $row['name'].' '.$row['ape'];?></a></td>
        <td align="center"> <img src="img/sweb/<?php echo $sim;?>" alt="Activo" border="0"> </td>
        <td align="left"><?php echo $row['ci'];?></td>
        <td align="left"><?php echo $row['address']; ?></td>
        <td align="center"><?php echo $row['phone'];?></td>
        <td align="center"><?php echo $row['cell'];?></td>
      </tr>
       <?php if($sw=='1')
	      $sw=0;
		   else 
		    $sw=1;
	     $cnt++;        
	      } ?>     	
    </tbody>
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
