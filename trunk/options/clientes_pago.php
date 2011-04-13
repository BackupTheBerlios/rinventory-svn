<?php 
mysql_connect("localhost","root","");
mysql_select_db("dvdstore_on");
$namec=$_GET['name'];
$qry= mysql_query("SELECT dv.id,dc.name, dc.ape, dv.total,dc.ci,dv.fecha,dv.estado FROM dvd_cliente dc INNER JOIN dvd_venta dv on dc.id=dv.idcliente Where (dc.name like '%".$namec."%' OR dc.ape like '%".$namec."%') AND dv.estado='D' ");	       
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script>
function cargar(iditem,name,total,saldo,fecha){
//opener.document.form1.productos.value+=producto+"\n";
opener.document.adminForm.cliente.value=name;
opener.document.adminForm.total.value=total;
opener.document.adminForm.nventa.value=iditem;
opener.document.adminForm.saldo.value=saldo;
opener.document.adminForm.fecha.value=fecha;
 // var Tabla = document.form1.getElementById("ventas");
 /* cantidad=prompt("Ingrese la cantidad de "+producto,'1'); 
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
opener.document.adminForm.precio.value=valor+valor2;*/
window.close();

}

function pagos(cuotas)
{
// var pagos=new array();
  //alert(cuotas[0]+', '+cuotas[1]);
}
</script>
</head>

<body>
<form name="f1" id="f1" action="index.php?pages=pago" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left:02em;">No.</td>
    <td>&nbsp;&nbsp;Cliente</td>
    <td>C.I.</td>
    <td>Monto</td> 
    <td>Fecha</td>
    <td>Estado</td>
  </tr>
  <?php $cnt=1;  while($row=mysql_fetch_assoc($qry)){
     
	 mysql_connect("localhost","root","");
     mysql_select_db("dvdstore_on"); 
     $qrs= mysql_query("SELECT monto as pagos from dvd_pagos WHERE idventa='".$row['id']."'");	
	   $saldo=0;
	   $pagos=array();
	   $pagos[0]='2';
	   $pagos[1]='3';
	   while($rws=mysql_fetch_assoc($qrs))	  
       $saldo=$saldo+$rws['pagos'];
	   
	   $saldo=$row['total']-$saldo;
	     
	   
	 ?><tr>
     <td style="padding-left:03em;"><?php echo $cnt; ?></td>
    <td><?php echo $row['name'].' '.$row['ape'] ?></td>
    <td><?php echo $row['ci'];?></td>
    <td><?php echo $row['total']?></td>
    <td><?php echo $row['estado'] ?></td>
    <td><input type="button" name="Submit" value="cargar" onClick="pagos('<?php echo $pagos?>'); cargar('<?php echo $row['id']?>','<?php echo $row['name'].' '.$row['ape'] ?>',<?php echo $row['total'] ?>,'<?php echo $saldo;?>','<?php echo $row['fecha'];?>')"></td>
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
