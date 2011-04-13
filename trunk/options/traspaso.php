<?php
//require 'inc/conexion.php';

  //echo "name: ".$_POST['name'].' - '.$_POST['contact_name'].' - '.$_POST['active'];
  if($_POST['iditem'])
 $iditem=$_POST['iditem'];
  echo "idlote".$iditem;
  if ($_POST['id'])
  $id=$_POST['idalm'];
  $name=$_POST['name'];
  $alm=$_POST['almacen'];
//  $iditem=$_POST['producto'];
  $cant=$_POST['cantidad'];
  $alm2=$_POST['almacend'];  
  $note=$_POST['notes'];
  
//echo "La imagen subio correctamente"; 
  if ($_POST['hw'])
    {/*   $con=new Conexion();
	$link=$con->conectar("dvdstore_on");
	   mysql_query("UPDATE dvd_departament SET name='$name', contact_name='$contactn', phone='$phone',active='$active', address='$address', fax='$fax', website='$wsite', email='$email', image='$ruta', description='$note' where id='".$id."' ");
	   mysql_close($link);*/
	  
	}else
	{
    $con=new Conexion();
	$link=$con->conectar("dvdstore_on");
	mysql_query("INSERT INTO dvd_traspaso VALUES('','1','$alm','$cant','$alm2','$idtem','2011-01-18','$note')");
	mysql_close($link); 
	
	$conc=new Conexion();
	$linkc=$conc->conectar("dvdstore_on");
	mysql_query("UPDATE dvd_lote  SET  stock=stock-$cant where id='$iditem'");
	mysql_close($linkc); 

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
          <th class="categories"><script language="JavaScript" type="text/javascript"> od_displayImage('logo_Departamentos', 'img/sweb/departamentos',48,48 ,'icon-png','Departamentos');</script>
              <img src="img/sweb/departamentos.png" alt="Departamentos" name="logo_Departamentos" width="48" height="48" border="0" class="icon-png" id="logo_Departamentos" /> Departamentos</th>
        </tr>
      </tbody>
    </table>
    <form action="index.php?pages=almacen" method="post" enctype="multipart/form-data" name="adminForm" id="adminForm">
      <table class="adminform">
        <!--DWLayoutTable-->
        <tbody>
          <tr>
            <th colspan="3">Detalles</th>
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
