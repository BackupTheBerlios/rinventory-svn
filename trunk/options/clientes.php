<?php 
mysql_connect("localhost","root","");
mysql_select_db("dvdstore_on");
$qry=mysql_query('select id,name as producto,ape as precio from dvd_cliente');
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script>
function cargar(userid,producto,precio){

opener.document.adminForm.cliente.value=producto+" "+precio;
opener.document.adminForm.idclient.value=userid;
 // var Tabla = document.form1.getElementById("ventas");
   

window.close();

}
function agregar(){
 // document.clienteForm.
  //div = document.getElementById('cliente');
  //div.style.display = "";
    window.open('index.php?option=cliente','','width=800,height=600');
 // document.location='index.php?option=cliente';
}
</script>
</head>

<body>
<form name="f1" id="f1" action="" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="font-weight:bold">Nombre</td>
    <td style="font-weight:bold">Apellido</td>
    <td>&nbsp;</td>
  </tr>
  <?php while($row=mysql_fetch_assoc($qry)){?><tr>
    <td><?php echo $row['producto'] ?></td>
    <td><?php echo $row['precio'] ?></td>
    <td><input type="button" name="Submit" value="cargar" onClick="cargar('<?php echo $row['id'] ?>','<?php echo $row['producto'] ?>','<?php echo $row['precio'] ?>')"></td>
  </tr><?php } ?>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td><a href="javascript:agregar()"><div align="left">Agregar Cliente</div></a></td>
  </tr>
</table></form>

<div id="cliente" style="display:none">
<form action="index.php?pages=cliente" method="post" name="clienteForm" enctype="multipart/form-data">
  <table class="adminform">
    <!--DWLayoutTable-->
    <tbody>
      <tr>
        <th colspan="3">Formulario de Registro</th>
      </tr>
	  <tr>
	    <td nowrap="nowrap"><div align="right">Nombre:</div></td>
	    <td><input name="name" type="text" class="text_area" id="name" value="" size="60">
            <span class="obligatorio">*</span> </td>
	  </tr>
	  <tr>
	    <td nowrap="nowrap"><div align="right">Apellidos:</div></td>
	    <td><input name="apellidos" type="text" class="text_area" id="apellidos" value="" size="60">
            <span class="obligatorio">*</span> </td>
	  </tr>
	    
          <tr>
            <td nowrap="nowrap"><div align="right">C.I.:</div></td>
            <td><input name="ci" type="text" class="text_area" id="ci" value="" size="25">
              <span class="obligatorio">*</span></td>
          </tr>
		
       
      <tr>
        <td nowrap="nowrap" width="162"><div align="right">Direcci&oacute;n:</div></td>
        <td><input name="address" type="text" class="text_area" id="address" value="" size="60">        </td>
      </tr>
      <tr>
        <td nowrap="nowrap" width="162"><div align="right">Tel&eacute;fono:</div></td>
        <td><input name="phone" type="text" class="text_area" id="phone" value="" size="60">        </td>
      </tr>     
      <tr>
        <td nowrap="nowrap" width="162"><div align="right">Celular:</div></td>
        <td><input name="cell" type="text" class="text_area" id="cell" value="" size="60">        </td>
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
          <input name="id" type="hidden" id="id" value="">
          <input name="dirPath" type="hidden" id="dirPath" value="">
          <input name="hidemainmenu" value="{FORM_HIDE_MAIN_MENU}" type="hidden"></td>
      </tr>
    </tbody>
  </table>
</form>
</div>
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
