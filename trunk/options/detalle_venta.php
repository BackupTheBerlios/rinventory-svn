<style>
.st_tbcss,.st_tdcss,.st_divcss,.st_ftcss{border:none;padding:0px;margin:0px}
A.st_acss,A.st_acss:link,A.st_acss:visited,A.st_acss:active,A.st_acss:hover{background-color:transparent;font-style:normal;border:none}
.Estilo3 {font-family: Georgia, "Times New Roman", Times, serif; color: #FF0000; }
.Estilo4 {color: #000000}
.Estilo6 {font-family: Georgia, "Times New Roman", Times, serif; color: #000000; }
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


      <td class="menudottedline" width="40%"><div class="pathway"><a href="http://localhost/trunk/std/index.php?option=home" class="headerNavigation">Panel de Control</a> » <a href="http://localhost/trunk/std/index.php?pages=ventas_list" class="headerNavigation">Detalle de Ventas</a></div></td>


      <td class="menudottedline" align="right"><table id="toolbar" border="0" cellpadding="0" cellspacing="0">


          <tbody>


            <tr align="center" valign="middle">


			 <!-- start icons_toolbar_edit.inc.htm -->

<!-- end icons_toolbar_edit.inc.htm -->




            </tr>


          </tbody>


        </table></td>


    </tr>


  </tbody>


</table>

<script>
function agregar(){
window.open('index.php?pages=items','','width=600,height=600');
}
function finalizar(){
/*que=document.form1.productos.value;
que2=que.split("\n").join('<br/>');
que3=document.form1.precio.value;
document.getElementById('pp').innerHTML=que2+"<br/><br/>"+que3;
*/
var nf=document.getElementById("items").rows.length;
//alert('nf: '+nf);
//alert('value: '+document.getElemntById("items").rows[0].value);
//alert(''+document.getElementsByTagName('items')[0].innerHTML);
//alert(document.getElementsByTagName('items').rows[0].innerHTML);
if(confirm('¿Esta seguro que desea concretar la venta? '))
{
var tabla = document.getElementById('items'); 
filas = tabla.getElementsByTagName('tr'); 
var cont= 0; 
var a_items = new Array() ;
var n_items = new Array() ;
nf=nf;
for (i=1; i<nf ; i++) 
{ 
//alert('vl: '+tabla.rows[i].cells[0].innerHTM)
  a_items[i]= tabla.rows[i].cells[1].name;
 // alert(''+tabla.rows[i].cells[1].name);
  n_items[i]= tabla.rows[i].cells[2].innerHTML; 
//tabla.rows[i].cells[1].onclick = function() {crearInput(this)}; 
//tabla.rows[i].cells[2].onclick = function() {crearInput(this)}; 
//tabla.rows[i].cells[3].onclick = function() {crearInput(this)}; 
}
// alert(a_items);
 var arv = a_items.toString();
 var cantit= n_items.toString();
    
 document.adminForm.arv.value=arv;
 document.adminForm.cantit.value=cantit;
 document.adminForm.ptotal.value=document.adminForm.precio.value;
// window.open('index.php?pages=venta&items='+a_items);
 }
 
}
function clientes(){
window.open('index.php?pages=clientes','','width=600,height=600');
}
function cancelar(module)
{
    document.location='index.php?pages='+module;
}
</script>
<!-- end toolbar.inc.htm -->	<!-- start company.inc.htm -->

<div class="centermain" align="center">
  <div class="main">
    <!-- start form_users_edit.inc.htm -->
<table class="adminheading">
  <tbody>
    <tr>
      <th class="categories"><script language="javascript" type="text/javascript"> od_displayImage('logo_{USER}', 'img/sweb/user',48,48 ,'icon-png','{USER}');</script>
        <img src="img/sweb/proyectos.png" width="48" height="48" name="logo_{USER}" border="0" class="icon-png" alt="{USER}">&nbsp;Ventas</th>
    </tr>
  </tbody>
</table>
<form action="index.php?pages=venta" method="post" name="adminForm"  onSubmit="finalizar()" >
  <table class="ventaform">
    <!--DWLayoutTable-->
    <tbody><?php
    
	 $con=new Conexion();
    	  $link=$con->conectar("dvdstore_on");
  //$vend=$_POST['vend'];
  //$cli=$_POST['clie'];
   		  $idv=$_GET['id'];
		  
		  $conc=new Conexion();
    	  $linkc=$conc->conectar("dvdstore_on");
		  $qryc=mysql_query("Select dv.idplanp as tpago, dv.ppago, du.name, du.ape, dc.name as namec, dc.ape as apec from dvd_user du INNER JOIN (dvd_venta dv INNER JOIN dvd_cliente dc on dv.idcliente=dc.id)on dv.idusuario=du.id WHERE dv.id='".$idv."'");
		  $rwc=mysql_fetch_assoc($qryc);
		  $vend=$rwc['name'].' '.$rwc['ape'];
		  $cli=$rwc['namec'].' '.$rwc['apec'];
		  
//		  $ppago=$rwc['tpago'];
		   $dpp=$rwc['ppago'];
		    

 $qry=mysql_query("select  di.link_type_item as name, di.v_descr,dvi.cant,di.price_unit,dv.total,dv.idplanp from dvd_venta dv INNER JOIN (dvd_vitems dvi INNER JOIN dvd_item di on dvi.iditem=di.id)on dvi.idventa=dv.id WHERE dv.id='".$idv."'") ; 
	     //echo "nrws: ".mysql_num_rows($qry);
	?>
      <tr>
        <th colspan="5"><div align="center">Formulario deVenta</div></th>
      </tr>
	  
	    <tr>	    
		<td nowrap="nowrap"><div align="right">Vendedor:</div></td>
	    <td><input name="vendedor" type="text" class="text_area" id="vendedor" value="<?php echo $vend;?>" readonly="readonly" size="50">        </td>								
		</tr>		
			
	  <tr>
        <td nowrap="nowrap" width="162"><div align="right">Cliente:</div></td>
        <td><input name="cliente" type="text" class="text_area" readonly="readonly" id="cliente" value="<?php echo $cli;?>" size="50"></td>
		
		
	  </tr>	
      
       <tr>
        <td nowrap="nowrap" width="162"><div align="right">Tipo Pago:</div></td>
        <td><input name="cliente" type="text" class="text_area" readonly="readonly" id="cliente" value="<?php echo $dpp;?>" size="25"></td>
		
		
	  </tr>	
  

                
      <tr>
        <td colspan="11">
        <br/>
		<table bordercolor="#999999" border="1">
		<tbody id="items">
          <tr bgcolor="#CCCCCC">
            <td><div align="center" class="Estilo3 Estilo4">N&ordm;</div></td>
            <td width="250"><div align="center" class="Estilo6">Descripci&oacute;n</div></td>
            <td width="30"><div align="center" class="Estilo6">Cantidad</div></td>
            <td width="30"><div align="center" class="Estilo6">U/P</div></td>
            <td width="100"><div align="center" class="Estilo6">Total</div></td>
          </tr>
          
          <?php
		 
              $cnt=1; $prt=0;
              while($rw=mysql_fetch_assoc($qry))
			  { 
			     $prt=$rw['total'];
			   ?>
			    <tr>
            <td><div align="center" class="Estilo3 Estilo4"><?php echo $cnt; ?></div></td>
            <td width="250"><div align="center" class="Estilo6"><?php echo $rw['name'].' '.$rw['v_descr'];?></div></td>
            <td width="30"><div align="center" class="Estilo6"><?php echo $rw['cant']; ?></div></td>
            <td width="30"><div align="center" class="Estilo6"><?php echo $rw['price_unit']; ?></div></td>
            <td width="100"><div align="center" class="Estilo6"><?php echo $rw['price_unit']*$rw['cant'];?></div></td>
          </tr>
				
			<?php	
			 $cnt++;
			  }
			  
		  ?>
          
		 </tbody>
        </table>
            <div style="width:720px;">&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="hidden" name="idcli" id="idcli" value=""/>     
         <input align="right" name="precio" type="text" id="precio" value="<?php echo $prt; ?>" />          
        <input name="idclient" type="hidden" id="idclient" value="0">
        <input name="ptotal" type="hidden" id="ptotal" value="0">
        <input name="arv" type="hidden" value="0">
        <input name="cantit" type="hidden" value="0">
          <input name="option" value="{FORM_OPTION}" type="hidden">
	  <input name="old_passwd" type="hidden" id="old_passwd" value="">
          <input name="section" value="{FORM_SECTION}" type="hidden">
          <input name="task" value="" type="hidden">
          <input name="id" type="hidden" id="id" value="">
       
          <input name="hidemainmenu" value="{FORM_HIDE_MAIN_MENU}" type="hidden"></td>
      </tr>	  
    </tbody>	
  </table>
  
</form>
<!-- end form_users_edit.inc.htm -->
  </div>
</div>
