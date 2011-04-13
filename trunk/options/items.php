<?php 
mysql_connect("localhost","root","");
mysql_select_db("dvdstore_on");
$qry=mysql_query('select di.id,di.link_type_item as producto,di.v_descr,di.price_unit as precio,di.price_paq,di.price_box,dl.stock from dvd_item di INNER JOIN dvd_lote dl on di.id=dl.name Where dl.stock>0 order by v_descr asc');
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script>
function cargar(iditem,producto,precio){
//opener.document.form1.productos.value+=producto+"\n";

 // var Tabla = document.form1.getElementById("ventas");
  cantidad=prompt("Ingrese la cantidad de "+producto,'1'); 
    var miTabla=opener.document.getElementById("items"); 
	 //alert('nfilas: '+opener.document.getElementById("items").length);

	 //for (var i=0;i<document.getElementById(\\'TablaDatos\\').rows.length;i++)
	 //var f=miTabla.getElementsByTagName('td'); 
	var nf=opener.document.getElementById("items").rows.length;
    var fila = document.createElement("tr"); 
    var celda1 = document.createElement("td"); 
    var celda2 = document.createElement("td"); 
	var celda3 = document.createElement("td");
	var celda4 = document.createElement("td");
	var celda5 = document.createElement("td"); 
	   
       celda1.innerHTML = nf; 
       celda2.innerHTML = producto+"\n";
	   celda2.name=iditem;
	   celda3.innerHTML = cantidad;
	   celda4.innerHTML = precio;
	   celda5.innerHTML = precio*cantidad;
	fila.appendChild(celda1); 
    fila.appendChild(celda2); 
	fila.appendChild(celda3);
	fila.appendChild(celda4);
	fila.appendChild(celda5);
	
    miTabla.appendChild(fila);  
	

if(opener.document.adminForm.precio.value){
valor=parseInt(opener.document.adminForm.precio.value);}else{valor=0;}
valor2=parseInt(precio*cantidad);
//si usás decimales, reemplazá parseInt por parseFloat
opener.document.adminForm.precio.value=valor+valor2;
window.close();

}

</script>
</head>

<body>
<form name="f1" id="f1" action="" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left:02em;">No.</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Producto</td>
    <td>Grupo</td> 
    <td>Stock</td> 
    <td>Precio</td>
    <td>&nbsp;</td>
  </tr>
  <?php $cnt=1;  while($row=mysql_fetch_assoc($qry)){?><tr>
     <td style="padding-left:03em;"><?php echo $cnt; ?></td>
    <td><?php echo $row['v_descr'] ?></td>
    <td><?php echo $row['producto']?></td>
     <td><?php echo $row['stock']?></td>
    <td><?php echo $row['precio'] ?></td>
    <td><input type="button" name="Submit" value="cargar" onClick="cargar('<?php echo $row['id']?>','<?php echo $row['producto'].' '.$row['v_descr'] ?>',<?php echo $row['precio'] ?>)"></td>
  </tr><?php 
  $cnt++;
  }
  ?>
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
