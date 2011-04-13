<?php 
mysql_connect("localhost","root","");
mysql_select_db("dvdstore_on");
$qry=mysql_query('select dl.id,dd.name as almacen,di.link_type_item as producto,di.v_descr,dl.stock as precio FROM dvd_item di INNER JOIN(dvd_departament dd INNER JOIN dvd_lote dl on dd.id=dl.idalmacen) on di.id=dl.name');
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script>
function cargar(id,almacen,producto,precio){

opener.document.adminForm.iditem.value=id;
opener.document.adminForm.almacen.value=almacen;

opener.document.adminForm.producto.value=producto;

 // var Tabla = document.form1.getElementById("ventas");
   

window.close();

}

</script>
</head>

<body>
<form name="f1" id="f1" action="" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>Almacen</td>
    <td>Producto </td>
    <td>Stock</td>
    <td>&nbsp;</td>
  </tr>
  <?php while($row=mysql_fetch_assoc($qry)){?><tr>
    <td><?php echo $row['almacen'] ?></td>
    <td><?php echo $row['producto'] ?></td>    
    <td><?php echo $row['precio'] ?></td>
    <td><input type="button" name="Submit" value="cargar" onClick="cargar('<?php echo $row['id'] ?>','<?php echo $row['almacen'] ?>','<?php echo $row['producto'] ?>','<?php echo $row['precio'] ?>')"></td>
  </tr><?php } ?>
</table></form>
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
