
<?php
$id=$_POST['id'];
$name=$_POST['items'];
$box=$_POST['box'];
$units=$_POST['units'];
$stock=$_POST['stock'];
$active=isset($_POST['active']) ? $_POST['active'] : 0;
$almc=$_POST['almacen'];
$costo=$_POST['costo'];
$tmar=$_POST['tmar'];
$tter=$_POST['tter'];
$aduana=$_POST['aduana'];
$tbank=$_POST['tbank'];
$cade=$_POST['cade'];
$other=$_POST['other'];
$pricef=$_POST['pricef'];
//$freg=time('D:M:Y');
$notes=$_POST['notes'];
$res = FALSE;

//echo "La imagen subio correctamente"; 
if (isset($_POST['hw']))
	$res = $db->query("UPDATE ".TBL_LOT." SET name='$name', cajas='$box', unidades='$units',stock='$stock',active='$active',idalmacen='$almc', costo='$costo', tran_mar='$tmar', tran_ter='$tter', aduana='$aduana', trans_bank='$tbank', carga='$cade', otros='$other', price_final='$pricef', obs='$notes' where id='".$id."' ");	  
else 
	$res = $db->query("INSERT INTO ".TBL_LOT." VALUES('','$name','$box','$units','$stock','$active','$almc','$costo',NOW(),'admin','',NOW(),'$tmar','$tter','$aduana','$tbank','$cade','$other','$pricef','$notes')");
?>
<div class="centermain" align="center">
  <div class="main">
    <!-- start form_departamentos_edit.inc.htm -->
    <table class="adminheading">
      <tbody>
        <tr>
          <th class="categories"><img src="img/sweb/user.png" alt="Departamentos" name="logo_Departamentos" width="48" height="48" border="0" class="icon-png" id="logo_Departamentos" /> Usuario</th>
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
            <td><?php 
            	if ($res === TRUE)
            		echo "Se Registro Exitosamente! <img src='img/sweb/tick.png'> ";
            	else
            		echo "Ocurrio un error, por favor intente nuevamente.";
            	?>
            </td>
          </tr>
          <tr>
            <td nowrap="nowrap" width="250"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td><a href="index.php?option=home">Volver al Inicio</a> &nbsp;</td>
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
