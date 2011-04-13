<?php
//require 'inc/conexion.php';

  $idventa=$_POST['nventa'];   
  $tpago="Contado";
  if($_POST['ecuenta'])
  {
    $ecu=$_POST['ecuenta'];
    if($ecu=='D')
	  $tpago="Credito";
   $con=new Conexion();
   $link=$con->conectar("dvdstore_on");
   mysql_query("UPDATE dvd_venta SET estado='".$ecu."', ppago='$tpago' WHERE id='".$idventa."'");
   mysql_close($link);
  }
  else{
  $monto=$_POST['montop'];  
  $dtotal=$_POST['dtotal'];
  $saldo=$_POST['saldot'];
  
   
  $con=new Conexion();
  $link=$con->conectar("dvdstore_on");
mysql_query("INSERT INTO dvd_pagos VALUES('','$idventa','$monto',NOW(),'1')");
			
	//if verify
	$saldo=$saldo-$monto;
	echo "saldo:".$saldo;
	 if ($saldo==0)
	{
		mysql_query("UPDATE dvd_venta SET estado='C' WHERE id='".$idventa."'");
	}
	   
	mysql_close($link);
	
    }
?>
<div class="centermain" align="center">
  <div class="main">
    <!-- start form_departamentos_edit.inc.htm -->
    <script language="JavaScript" src="js/overlib_mini.js" type="text/javascript"></script>
    <link href="css/media.css" rel="stylesheet" type="text/css" />
    <table class="adminheading">
      <tbody>
        <tr>
          <th class="categories"><script language="JavaScript" type="text/javascript"> od_displayImage('logo_Departamentos', 'img/sweb/user',48,48 ,'icon-png','Departamentos');</script>
              <img src="img/sweb/user.png" alt="Departamentos" name="logo_Departamentos" width="48" height="48" border="0" class="icon-png" id="logo_Departamentos" /> Usuario</th>
        </tr>
      </tbody>
    </table>
    <form action="index.php?pages=almacen" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm">
      <table class="adminform">
        <!--DWLayoutTable-->
        <tbody>
          <tr>
            <th colspan="3">Informe</th>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td rowspan="8" valign="top"></td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td>Se Registro Exitosamente!. <img src="img/sweb/tick.png">&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><a href="http://localhost/trunk/std/index.php?option=home">Volver Home</a> &nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><!--DWLayoutEmptyCell-->&nbsp;</td>
          </tr>
          <tr>
            <td width="250" rowspan="2" valign="top" nowrap="nowrap"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="445" height="1"></td>
            <td></td>
          </tr>
          <tr>
            <td valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td></td>
          </tr>
          <tr>
            <td colspan="3"><br />
                <input name="option" value="com_departamentos" type="hidden" />
                <input name="section" value="" type="hidden" />
                <input name="task" value="" type="hidden" />
                <input name="id" type="hidden" id="id" value="" />
                <input name="dirPath" type="hidden" id="dirPath" value="" />
                <input name="hidemainmenu" value="0" type="hidden" /></td>
          </tr>
        </tbody>
      </table>
    </form>
    <!-- end form_departamentos_edit.inc.htm -->
  </div>
</div>
