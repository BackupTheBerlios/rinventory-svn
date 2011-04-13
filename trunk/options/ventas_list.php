<!-- start top_menu.inc.htm -->
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


      <td class="menudottedline" width="40%"><div class="pathway"><a href="http://localhost/trunk/std/index.php?option=home" class="headerNavigation">Panel de Control</a> >> <a href="index.php?pages=ventas_list" class="headerNavigation">Ventas</a></div></td>


      <td class="menudottedline" align="right"><table id="toolbar" border="0" cellpadding="0" cellspacing="0">


          <tbody>


            <tr align="center" valign="middle">


			 <!-- start icons_toolbar.inc.htm -->

<td><a class="toolbar" href="javascript:hideMainMenu();submitbutton('new');" onClick=""> <img src="img/sweb/new_f2.png" alt="Nuevo" name="new" align="middle" border="0"> <br>
  Nuevo</a> </td>
<td>&nbsp;</td>



<!-- end icons_toolbar.inc.htm -->

<script>
 function pendiente(idventa)
 {
   document.location='index.php?pages=pagos&sw=pnd&id='+idventa;
 }
 
 function buscar(){
 var word=document.searchForm.sword.value;
   document.location='index.php?pages=ventas_list&search='+word;
 }
 function listar(){
    var limit=document.adminForm.limit.value;
   document.location='index.php?pages=ventas_list&off='+limit
 }
</script>


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

<table style="padding-left:50px; text-align:left; height:50px; border:5px solid #FFFFFF; width:90%">
  <tbody>
    <tr>
      <th class="categories"><script language="javascript" type="text/javascript"> od_displayImage('logo_Inventario', 'img/sweb/proyectos',48,48 ,'icon-png','Inventario');</script><img src="img/sweb/proyectos.png" width="48" height="48" name="logo_Inventario" border="0" class="icon-png" alt="Inventario">
        Ventas <span id="filter"></span></th>
      <td align="center"><form name="searchForm" action="http://localhost/trunk/std/index.php?pages=ventas_list" method="post">
          <div align="right">
            <input type="text" name="sword"  size="20" value="- Buscar -" onBlur="if(this.value==&#39;&#39;) this.value=&#39;- Buscar -&#39;;" onFocus="if(this.value==&#39;- Buscar -&#39;) this.value=&#39;&#39;;">
            <input type="button" name="Buscar" value="Buscar" onclick="buscar('Hi!')">
            <input type="hidden" name="option" value="">
          </div>
        </form></td>
    </tr>
  </tbody>
</table>
<form action="http://localhost/trunk/std/index.php?pages=venta_new" method="post" name="adminForm">
  
     <table class="adminlist">
    <tbody>
      <tr>
        <th align="center" width="5">&nbsp;  </th>
        <th width="20"> <input name="toggle" value="" onClick="checkAll(9);" type="checkbox">
        </th>
        <th class="title"> <a href="javascript: listOrder('1');void(0);">Usuario</a> 
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12 ,'icon-png','Ordenar');</script><img src="img/sweb//pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th align="left"> <a href="javascript: listOrder('2');void(0);">Fecha</a> 
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
		 <th nowrap="nowrap" align="center" width="90"> <a href="javascript: listOrder('4');void(0);">Cliente</a> 
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
		<th nowrap="nowrap" align="center" width="90"> <a href="javascript: listOrder('5');void(0);">Monto</a> 
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
		 <th nowrap="nowrap" align="center"> <a href="javascript: listOrder('7');void(0);">&nbsp;Saldo</a> 
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
		<th nowrap="nowrap" align="center"> <a href="javascript: listOrder('6');void(0);">Estado Cuenta</a> 
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
	<th nowrap="nowrap" align="center"> <a href="javascript: listOrder('7');void(0);">Plan de Pago</a> 
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>
        <th align="center"> <a href="javascript: listOrder('3');void(0);"> Detalles </a> 
          <script language="javascript" type="text/javascript"> od_displayImage('Ordenar', 'img/sweb/pixel_trans',12,12  ,'icon-png','Ordenar');</script><img src="img/sweb/pixel_trans.png" width="12" height="12" name="Ordenar" border="0" class="icon-png" alt="Ordenar">
        </th>

		
		<?php //require 'inc/conexion.php'; 
		  if ($_GET['off'])
		       $limt=$_GET['off'];
			   else
		 $limt=10;
		  if($_GET['search'])	
		  {	 $srch=$_GET['search'];   
		 $sqls="Select dv.id, du.name, du.ape, dc.name as namec, dc.ape as apec, dv.fecha, dv.total, dv.ppago, dv.estado from dvd_cliente dc INNER JOIN (dvd_user du INNER JOIN dvd_venta dv on du.id=dv.idusuario) on dv.idcliente=dc.id AND (dc.ape like '%".$srch."%' OR dc.name like '%".$srch."%') order by dv.fecha desc";
		 }
		  else
		     $sqls="Select dv.id, du.name, du.ape, dc.name as namec, dc.ape as apec, dv.fecha, dv.total, dv.ppago, dv.estado from dvd_cliente dc INNER JOIN (dvd_user du INNER JOIN dvd_venta dv on du.id=dv.idusuario) on dv.idcliente=dc.id order by dv.fecha desc limit 0,".$limt;
			 
		$con=new Conexion();
	    $link=$con->conectar("dvdstore_on");
		
	    $res=mysql_query($sqls);
		
		
		$sw=0; $cnt=1;
	    while($row=mysql_fetch_assoc($res))
	     {
		    
	  		 
		
		$imgl="tick.png";
		   $pp=$row['ppago'];
		   
		   $saldo="0";
		
         if ($row['estado']=='D')
		  {
		   $imgl="publish_x.png";				  		   
		   
		    mysql_connect("localhost","root","");
            mysql_select_db("dvdstore_on"); 
            $qrs= mysql_query("SELECT monto as pagos from dvd_pagos WHERE idventa='".$row['id']."'");	
	        $saldo=0;
	        while($rws=mysql_fetch_assoc($qrs))	  
            $saldo=$saldo+$rws['pagos'];
	   
	         $saldo=$row['total']-$saldo;
		      
		  } 
		   else
		     if ($row['estado']=='P'){
			  $imgl="pend.png";				  
			  $msgit="Pendiente";
			 }
		 ?>
      </tr><tr class="row<?php echo $sw;?>">
        <td align="center">&nbsp;  </td>
        <td><input id="cb0" name="cid[]" value="60" onClick="isChecked(this.checked);" type="checkbox"> </td>
        <td align="left"><?php echo $row['name'].' - '.$row['ape'];?></td>
        <td align="left"><?php echo $row['fecha'];?></td>
        <td align="center"><?php echo $row['namec'].' '.$row['apec'];?></td>
		<td align="center"><?php echo $row['total'];?></td>
		<td align="center"><?php echo $saldo;?></td>
		<td align="center"><strong><a href="javascript:pendiente('<?php echo $row['id'];?>')" title="<?php echo $pp; ?>"><img src="img/sweb/<?php echo $imgl;?>" alt="Activo" border="0"></a>
		 <?php if ($row['estado']=='D') {?>
		&nbsp;&nbsp;<a href="index.php?pages=pagos&id=<?php echo $row['id'];?>" title="registrar pagos"><img src="img/sweb/<?php echo "sort_asc.png";?>" alt="Activo" border="0"></a>
		<?php } ?>
		</strong></td> 
		
        <td align="center"><?php echo $pp;?></td>
		<td align="center"><a href="index.php?pages=detalle_venta&id=<?php echo $row['id']?>">Detalles..</a></td>
	          
		
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
        <th colspan="3"><span class="pagenav">Paginas de Resultados: &nbsp;<b>1</b>&nbsp;</span></th>
      </tr>
      <tr>
        <td align="right" nowrap="true" width="48%">Mostrar #</td>
        <td><select name="limit" class="inputbox" size="1" onChange="listar();">
        <?php $slc=" selected='selected'";
		?>
        <option value="5"<?php if ($limt=='5') echo $slc;?> >5</option>
        <option value="10" <?php if ($limt=='10') echo $slc;?> >10</option>
        <option value="15" <?php if ($limt=='15') echo $slc;?> >15</option>
        <option value="20" <?php if ($limt=='20') echo $slc;?> >20</option>
        <option value="25" <?php if ($limt=='25') echo $slc;?> >25</option>
        <option value="30" <?php if ($limt=='30') echo $slc;?> >30</option>
        <option value="50" <?php if ($limt=='50') echo $slc;?> >50</option>
        <option value="100" <?php if ($limt=='100') echo $slc;?> >100</option>
        </select> </td>
        <td align="left" nowrap="true" width="48%"> Lista de Resultados </td>
      </tr>
    </tbody>
  </table>
  <input name="option" value="inventario" type="hidden">
  <input name="section" value="" type="hidden">
  <input name="task" value="new" type="hidden">
  <input name="chosen" value="" type="hidden">
  <input name="act" value="" type="hidden">
  <input name="boxchecked" value="0" type="hidden">
  <input name="type" value="list" type="hidden">
  <input name="hidemainmenu" value="1" type="hidden">
  <input name="order" type="hidden" id="order" value="{FORM_ORDER_BY}">
  <input name="flag_order" type="hidden" id="flag_order" value="0">
</form>
<!-- end form_users_list.inc.htm -->

  </div>
</div>
<!-- end company.inc.htm -->
