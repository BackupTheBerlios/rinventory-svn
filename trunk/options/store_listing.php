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


      <td class="menudottedline" width="40%"><div class="pathway"><a href="http://localhost/trunk/std/index.php?option=home" class="headerNavigation">Panel de Control</a> » <a href="index.php?pages=almacen_list" class="headerNavigation">Almacen</a></div></td>


      <td class="menudottedline" align="right"><table id="toolbar" border="0" cellpadding="0" cellspacing="0">


          <tbody>


            <tr align="center" valign="middle">


			 <!-- start icons_toolbar.inc.htm -->

<td><a class="toolbar" href="javascript:submitbutton('new');" onClick=""> <img src="img/sweb/new_f2.png" alt="Nuevo" name="new" align="middle" border="0"> <br>
  Nuevo</a> </td>    
<td>&nbsp;</td>

<td><a class="toolbar" href="javascript:if (document.adminForm.boxchecked.value == 0){ alert('Por favor haga una selección de la lista a eliminar'); } else if (confirm('¿Esta seguro que desea eliminar los items seleccionados? ')){ submitbutton('remove');}" onClick=""> <img src="img/sweb/delete_f2.png" alt="Borrar" name="delete" align="middle" border="0"> <br>
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
    <!-- start form_departamentos_list.inc.htm -->

<table class="adminheading">
  <tbody>
    <tr>
      <th class="categories"><script language="javascript" type="text/javascript"> od_displayImage('logo_Departamentos', 'img/sweb/departamentos',48,48 ,'icon-png','Departamentos');</script><img src="img/sweb/departamentos.png" width="48" height="48" name="logo_Departamentos" border="0" class="icon-png" alt="Departamentos">
        Almacen <span id="filter"></span></th>
    </tr>
  </tbody>
</table>
<form action="http://localhost/trunk/std/index.php?option=almacen_new" method="post" name="adminForm">
  
-      <table class="adminlist">
    <tbody>
      <tr>
        <th align="center" width="25"> <a href="javascript: listOrder('0');void(0);">
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12 ,'icon-png','Ordenar');</script><img src="img/sweb//pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
          </a> </th>
        <th width="20"> <input name="toggle" value="" onClick="checkAll(2);" type="checkbox">
        </th>
        <th class="title"> <a href="javascript: listOrder('1');void(0);">Nombre </a>
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12 ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th align="left"> <a href="javascript: listOrder('3');void(0);">Cantidad</a>
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th align="left"> <a href="javascript: listOrder('4');void(0);">Traspaso </a>
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th nowrap="nowrap"> <a href="javascript: listOrder('5');void(0);">De</a>
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th> Fecha</th>
		
		<?php //require 'inc/conexion.php'; 
		$idalm=$_GET['id'];		
		$con=new Conexion();
	    $link=$con->conectar("dvdstore_on");
	    $res=mysql_query("SELECT di.link_type_item as name,dl.hw_added, di.v_descr, dl.stock from dvd_item di INNER JOIN dvd_lote dl on di.id=dl.name WHERE dl.idalmacen='".$idalm."'");
		//SELECT dd.name,dl.stock,dt.cant FROM dvd_traspaso dt INNER JOIN (dvd_departament dd INNER JOIN dvd_lote dl on dd.id=dl.idalmacen)on dt.idalmacen2=dd.id
		$sw=0; $cnt=1;
	    while($row=mysql_fetch_assoc($res))
	     {			 
			$sim="tick.png";
			if($row['active']==0)
			 $sim="publish_x.png";  			 
	  ?>	   
      </tr><tr class="row<?php echo $sw;?>">
        <td align="center"> <?php echo $cnt; ?> </td>
        <td><input id="cb0" name="cid[]" value="15" onClick="isChecked(this.checked);" type="checkbox"> </td>
        <td><a href="index.php?pages=modify_alm&id=<?php echo $row['id'];?>"><?php echo $row['name'].' - '.$row['v_descr'];?></a></td>
        <td align="left"><?php echo $row['stock'];?></td>
        <td align="left"><img src="img/sweb/<?php echo $sim;?>" alt="Activo" border="0"></td>
        <td align="center"><?php echo "";?></td>
        <td align="center"><a href="#"><?php echo $row['hw_added'] ?></a></td>
      </tr>
	  <?php if($sw=='1')
	      $sw=0;
		   else 
		    $sw=1;
	     $cnt++;        
	      } 
		  
		  //traspasos
		$conc=new Conexion();
	    $linkc=$conc->conectar("dvdstore_on");
	    $resc=mysql_query("SELECT di.link_type_item as name,dt.fecha, di.v_descr, dt.cant,dt.idalmacen from dvd_item di INNER JOIN dvd_traspaso dt on di.id=dt.iditem WHERE dt.idalmacen2='".$idalm."'");
		$sw=0; $cnt=1;
	    while($rowc=mysql_fetch_assoc($resc))
	     {			 
			$sim="tick.png";
			//if($row['active']==0)
			// $sim="publish_x.png";  			 
          ?>
               
      </tr><tr class="row<?php echo $sw;?>">
        <td align="center"> <?php echo $cnt; ?> </td>
        <td><input id="cb0" name="cid[]" value="15" onClick="isChecked(this.checked);" type="checkbox"> </td>
        <td><a href="index.php?pages=modify_alm&id=<?php echo $rowc['id'];?>"><?php echo $rowc['name'].' - '.$rowc['v_descr'];?></a></td>
        <td align="left"><?php echo $rowc['cant'];?></td>
        <td align="left"><img src="img/sweb/<?php echo $sim;?>" alt="Activo" border="0"></td>
        <td align="center"><?php echo $rowc['idalmacen'];?></td>
        <td align="center"><a href="#"><?php echo $rowc['fecha'] ?></a></td>
      </tr>
	  <?php if($sw=='1')
	      $sw=0;
		   else 
		    $sw=1;
	     $cnt++;        
	      } ?>     	  
          
    </tbody>
  </table>
  <table class="adminlist">
    <tbody>
      <tr>
        <th colspan="4"><span class="pagenav">Paginas de Resultados: &nbsp;<b>1</b>&nbsp;</span></th>
      </tr>
      <tr>
        <td align="right" nowrap="true" width="48%">Mostrar #</td>
        <td><select name="limit" class="inputbox" size="1" onChange="document.adminForm.submit();"><option value="5">5</option><option value="10">10</option><option value="15">15</option><option value="20">20</option><option value="25">25</option><option value="30" selected="">30</option><option value="50">50</option><option value="100">100</option></select> </td>
        <td align="left" nowrap="true" width="48%"> Lista de Resultados </td>
      </tr>
    </tbody>
  </table>
  <input name="option" value="com_departamentos" type="hidden">
  <input name="section" value="" type="hidden">
  <input name="task" value="" type="hidden">  
  <input name="module" value="almacen" id="module" type="hidden">
  <input name="act" value="" type="hidden">
  <input name="boxchecked" value="0" type="hidden">
  <input name="type" value="list" type="hidden">
  <input name="order" type="hidden" id="order" value="{FORM_ORDER_BY}">
  <input name="flag_order" type="hidden" id="flag_order" value="0">
</form>

<!-- end form_departamentos_list.inc.htm -->
  </div>
</div>
