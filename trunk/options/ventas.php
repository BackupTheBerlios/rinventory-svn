<html>
<head>
<title>Ventas</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script id="Sothink Widgets:top_menu.inc.pgt" type="text/javascript" language="JavaScript1.2"></script>
<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">


  <tbody>


    <tr>


      <td class="menudottedline" width="40%"><div class="pathway"><a href="http://localhost/trunk/std/index.php?option=home" class="headerNavigation">Panel de Control</a> » <a href="http://localhost/trunk/std/index.php?option=home" class="headerNavigation">Ventas</a></div></td>


      <td class="menudottedline" align="right"><table id="toolbar" border="0" cellpadding="0" cellspacing="0">


          <tbody>


            <tr align="center" valign="middle">


			 <!-- start icons_toolbar_edit.inc.htm -->
<td>  
  <a class="toolbar" href="javascript:showMainMenu();if ($F('cliente')==''){alert('Ingrese el Cliente');} else{ submitbutton('save');}" onClick=""> <img src="img/sweb/save_f2.png" alt="Activo" name="active" align="middle" border="0"> <br> Guardar </a>
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
confirm('¿Esta seguro que desea concretar la venta? ');
//var tabla = document.getElementById('items'); 
//filas = tabla.getElementsByTagName('tr'); 
//var cont= 0; 
//for (i=1; i< tabla.rows.length; i++) 
//{ 
//alert('vl: '+tabla.rows[i].cells[0].innerHTM)
//tabla.rows[i].cells[1].onclick = function() {crearInput(this)}; 
//tabla.rows[i].cells[2].onclick = function() {crearInput(this)}; 
//tabla.rows[i].cells[3].onclick = function() {crearInput(this)}; 
//}
 
}
function clientes(){
window.open('index.php?pages=clientes','','width=600,height=600');
}

</script>
</head>

<body>
<form name="form1" method="post" action="index.php?pages=venta.php" enctype="multipart/form-data">
  <p>
    
  <table class="ventaform">
    <!--DWLayoutTable-->
    <tbody id="cuerpoTabla">
      <tr>
        <th colspan="5"><div align="center">Formulario deVenta</div></th>
      </tr>
	  
	    <tr>
	    
		<td nowrap="nowrap"><div align="right">Vendedor:</div></td>
	    <td><input name="vendedor" type="text" class="text_area" id="vendedor" value="usuario prueba" size="50">        </td>				
			
		<td><div align="right">Fecha:</div></td>
           <td><input name="fecha" type="text" class="text_area" id="fecha" value="<?php echo date("j-n-y") ?>" size="25"></td>
		</tr>		
			
	  <tr>
        <td nowrap="nowrap" width="162"><div align="right">Cliente:</div></td>
        <td><input name="cliente" type="text"  id="cliente" value="" size="50"><a href="javascript:clientes()">Clientes</a></td>
		 <td width="150"><div></div><div align="right">NIT:</div></td>
         <td><input name="nit" type="text" class="text_area" id="nit" value="" size="25"></td>
	  </tr>	                 
      <tr>
        <td colspan="11">
		<table bordercolor="#999999" border="1">
        <tbody id="items">
          <tr bgcolor="#CCCCCC">
            <td><div align="center" class="Estilo3 Estilo4">N&ordm;</div></td>
            <td width="250"><div align="center" class="Estilo6">Descripci&oacute;n</div></td>
            <td width="30"><div align="center" class="Estilo6">Cantidad</div></td>
            <td width="30"><div align="center" class="Estilo6">Precio</div></td>
            <td width="100"><div align="center" class="Estilo6">Total</div></td>
          </tr>         
           </tbody>
        </table>
        <div style="width:700px;">
          <input type="button" name="Submit3" value="agregar producto" onClick="agregar()" />&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="button" name="Submit4" value="Finalizar" onClick="finalizar()" />
         <input type="hidden" name="idcli" id="idcli" value=""/>     
         <input align="right" name="precio" type="text" id="precio" />          
           </div></td>
      </tr>
    </tbody>
  </table>

     
  <p>&nbsp;  </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    </p>
</form>
<div id="pp">&nbsp;</div>
</body>
</html><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
</body>
</html>
