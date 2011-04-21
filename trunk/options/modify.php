<?php
require_once 'inc/class.mysqli.php';

$db = Database::getInstance();
?>
<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td class="menudottedline" width="40%"><div class="pathway"><a href="index.php?option=home" class="headerNavigation">Panel de Control</a> <?php echo SB_BREADCRUMB;?> <a href="index.php?pages=inventario_list" class="headerNavigation">Inventario</a></div></td>
	<td class="menudottedline" align="right">
		<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
		<tr align="center" valign="middle">
		<!-- start icons_toolbar_edit.inc.htm -->
			<td>  
				<a class="toolbar" href="javascript:if(jQuery('#name').val()==''){alert('Por favor ingrese el nombre');} else if(jQuery('#stockmin').val()==''){alert('Por favor ingrese el Stock Mínimo');} else{ showMainMenu();submitbutton('save');}" onclick=""> <img src="img/sweb/save_f2.png" alt="Activo" name="active" align="middle" border="0"/> <br> Guardar </a>
			</td>
			<td>&nbsp;</td>
			<td>
				<a class="toolbar" href="javascript:showMainMenu();submitbutton('cancel');" onClick=""> <img src="img/sweb/cancel_f2.png" alt="Cancelar" name="new" align="middle" border="0"/> <br/> Cancelar</a>
			</td>
			<td>&nbsp;</td>
		<!-- end icons_toolbar_edit.inc.htm -->
		</tr>
		</table>
	</td>
</tr>
</table>

<!-- end toolbar.inc.htm -->
<!-- start company.inc.htm -->

<div class="centermain" align="center">
  <div class="main">
    <!-- start form_users_edit.inc.htm -->
<script type="text/javascript"> 
// don't remove this script
function ReloadCat(){	
	var f=document.adminForm;
	var prod=f.items.options[f.items.selectedIndex].text;
	
	if (prod=='Dvd-cd')
		document.location='index.php?pages=inventario_new&item=multiple&prod='+prod;
	else {
		if (prod=='Estuches')
			document.location='index.php?pages=inventario_new&item=normal&prod='+prod;
		else 
			document.location='index.php?pages=inventario_new&item=stnd&prod='+prod;
	}
}
</script> 
<table class="adminheading">
<tr>
	<th class="categories"><img src="img/sweb/inventario.png" width="48" height="48" name="logo_Inventario" border="0" class="icon-png" alt="Inventario"> Inventario</th>
</tr>
</table>
<?php
if(isset($_GET['item']))
	$titem=$_GET['item'];
?>

<form action="index.php?pages=inventario&item=<?php echo $titem;?>&hw=mdf" method="post" name="adminForm" enctype="multipart/form-data">
  <table class="adminform">
    <!--DWLayoutTable-->
    <tbody>
      <tr>
        <th colspan="3">Formulario de Registro</th>
      </tr>

      <tr>
	    <td nowrap="nowrap"><div align="right">Producto:</div></td>
      
        
	    <td>
			<select name="items" id="items" style="width:250px;" class="text_area" onChange="ReloadCat()">
<?php  	
$slc="";
$titem="";

if ($_GET['item'])
    $titem=$_GET['item'];
if($_GET['id'])	{
	//$slc="selected='selected'";
	$itemid=$_GET['id'];
}
//if($_GET['item'])
//   $titem=$_GET['item'];
$prod="";
		
$res=$db->query("SELECT *from ".TBL_ITEM." where id='$itemid'");
// while($row=mysql_fetch_assoc($res))
if ($db->rows($res, 0)>0)
	$row=$db->getRow($res, 0);
?> 
			<option value="<?php echo $row['id'];?>"> <?php echo $row['link_type_item']; ?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td nowrap="nowrap" width="162"><div align="right">Nombre:</div></td>
        <td><input name="name" type="text" class="text_area" id="name" value="<?php echo $row['v_descr'];?>" size="25" maxlength="25"> 
        <span class="obligatorio">*</span>        </td>
	</tr> 
<?php 

if($titem!="multiple"){
?>
	<tr>
		<td nowrap="nowrap"><div align="right">Material:</div></td>
		<td><input name="material" type="text" class="text_area" id="material" value="<?php echo $row['material'];?>" size="25" maxlength="25" /> <span class="obligatorio">*</span></td>
	</tr>
<?php 
} 

if($titem=="stnd") { ?>
	<tr>
		<td nowrap="nowrap"><div align="right">Color:</div></td>
		<td>
			<select name="color" id="select" style="width:250px;" class="text_area">
			<option value=""></option>
<?php  
	$slc="selected='selected'";
	$resc=$db->query("Select * from dvd_color");
	
	while($rowc=$db->getRow($resc,0)) {
?>
			<option value="<?php echo $rowc['name'];?>"  <?php if ($rowc['name']==$row['link_color']) echo $slc; ?> ><?php echo $rowc['name']; ?></option>
<?php
	}
?>
		 
			</select>	 
		</td>
	</tr>
<?php 
}

if($titem=="normal") { ?>
	<tr>
		<td nowrap="nowrap"><div align="right">Espesor:</div></td>
		<td>
			<select name="espes" id="espes" style="width:250px;" class="text_area">
			<option value=""></option>
<?php  
	$resc=$db->query("Select * from dvd_spesor");

	while($rowc=$db->getRow($resc, 0)) {
?>
			<option value="<?php echo $rowc['name'];?>"  <?php if ($rowc['name']==$row['v_60_5']) echo $slc; ?> ><?php echo $rowc['name']; ?></option>
<?php
	}
?>
			</select>	 
			<span class="obligatorio">*</span>
		</td>
	</tr>
<?php 
}
?>
	<tr>
	    <td nowrap="nowrap"><div align="right">Marca:</div></td>
	    <td>
			<select name="marker" id="select" style="width:250px;" class="text_area">	
<?php 
$slc="selected='selected'";
$resc=$db->query("Select * from dvd_marker");
		  
while($rowc=$db->getRow($resc,0)) {
	echo $row['link_marca'];
?>
			<option value="<?php echo $rowc['name'];?>" <?php if ($rowc['name']==$row['link_marca']) echo $slc; ?> ><?php echo $rowc['name']; ?></option>
<?php
}
?>
			</select>
		</td>
	</tr>
<?php
if($titem=="multiple"){
	$chek="";
	
	if($row['rewrite']==1)
		$chek="checked='checked'"; 
?>
	<tr>
		<td nowrap="nowrap" width="250"><div align="right">Regrabable:</div></td>
        <td><input name="regr" type="checkbox" id="regr" <?php echo $chek; ?> value="<?php echo $row['rewrite'];?>" /></td>
	</tr>
<?php 
	} 
?>
	<tr>
		<td nowrap="nowrap"><div align="right">Precio Unitario:</div></td>
	    <td><input name="price_unit" type="text" class="text_area" id="price_unit" value="<?php echo $row['price_unit']; ?>" size="25" />
          <span class="obligatorio">*</span></td>
	</tr>
	<tr>
		<td nowrap="nowrap"><div align="right">Precio Paquete:</div></td>
		<td><input name="price_paq" type="text" class="text_area" id="price_paq" value="<?php echo $row['price_paq']; ?>" size="25" />
          <span class="obligatorio">*</span></td>
	</tr>
	<tr>
		<td nowrap="nowrap"><div align="right">Precio Caja:</div></td>
		<td><input name="price_box" type="text" class="text_area" id="price_box" value="<?php echo $row['price_box']; ?>" size="25" /> <span class="obligatorio">*</span></td>
	</tr>
	<tr>
		<td nowrap="nowrap" width="162"><div align="right">Stock M&iacute;nimo:</div></td>
		<td><input name="stockmin" type="text" class="text_area" id="stockmin" value="<?php echo $row['stock_min']; ?>" size="25"></td>
	</tr>
<?php 
	if($_GET['item'])
		$titem=$_GET['item'];
	
	if($titem=="normal"){
?>
	<tr>
		<td><div align="right">Para:</div></td>
		<td>
			<select name="spara" id="spara" style="width:250px;" class="text_area">
		    <option value=""></option>
<?php  
		$resc = $db->query("Select name from dvd_for");

		while( $rowc=$db->getRow($resc, 0)) {
?>
			<option value="<?php echo $rowc['name'];?>" <?php if ($rowc['name']==$row['link_for']) echo $slc; ?>><?php echo $rowc['name']; ?></option>
<?php
		}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td><div align="right">Tipo Estuche:</div></td>
		<td>
			<select name="tstch" id="tstch" style="width:250px;" class="text_area">
			<option value=""></option>
<?php 
		$resc=$db->query("Select name from dvd_type_stch");

		while($rowc=$db->getRow($resc,0)){
			echo "v60_6: ".$row['v_60_6'];
?>
			<option value="<?php echo $rowc['name'];?>" <?php if ($rowc['name']==$row['v_60_6']) echo $slc; ?>><?php echo $rowc['name']; ?></option>
<?php
		}
?>
			</select>
		</td>
	</tr>
<?php 
	} 

	if($titem=="multiple"){
?>
	<tr>
		<td><div align="right">Velocidad:</div></td>
		<td>
			<select name="velocity" id="velocity" style="width:250px;" class="text_area">
		    <option value=""></option>
<?php 
		$resc = $db->query("Select name from dvd_velocity");
		
		while($rowc = $getRow($resc, 0)) {
?>
			<option value="<?php echo $rowc['name'];?>"  <?php if ($rowc['name']==$row['v_60_1']) echo $slc; ?> ><?php echo $rowc['name']; ?></option>
<?php
		}
 ?>
			</select>
		</td>
	</tr>
	<tr>
		<td><div align="right">Paquete:</div></td>
		<td>
			<select name="paquete" id="paquete" style="width:250px;" class="text_area">
			<option value=""></option>
<?php  
		$slc="selected='selected'"; 
	    $resc=$db->query("Select name from dvd_paquete");
		
		while($rowc=$db->getRow($resc, 0)){
?>
			<option value="<?php echo $rowc['name'];?>" <?php if ($rowc['name']==$row['v_60_2']) echo $slc; ?> ><?php echo $rowc['name']; ?></option>
<?php
		}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td><div align="right">Envase:</div></td>
		<td>
			<select name="envase" id="envase" style="width:250px;" class="text_area">
			<option value=""></option>
<?php
		$resc = $db->query("Select name from dvd_envase order by name");
		
		while($rowc=$db->getRow($resc, 0)) {
?>
			<option value="<?php echo $rowc['name'];?>" <?php if ($rowc['name']==$row['v_60_3']) echo $slc; ?>><?php echo $rowc['name']; ?></option>
<?php
		}
?>
			</select>
		</td>
	</tr>
<?php 
	} //end multiple

	if(($titem=='multiple')/*||($titem=="normal")*/){
?>
	<tr>
		<td><div align="right">Capacidad:</div></td>
		<td>
			<select name="capacidad" id="capacidad" style="width:250px;" class="text_area">
			<option value=""></option>
<?php
		$resc=$db->query("Select name from dvd_capacity order by name");
		
		while($rowc = $db->getRow($resc)) {
?>
			<option value="<?php echo $rowc['name'];?> " <?php if ($rowc['name']==$row['v_60_4']) echo $slc; ?>><?php echo $rowc['name']; ?></option>
<?php
		}
?>
			</select>
		</td>
	</tr>
<?php 
	} 
?>
	   <tr>
		<td valign="top"><div align="right">Observaciones:</div></td>
		<td><textarea id="notas" class="text_area" rows="3" cols="43" name="notas"><?php echo $row['description']; ?></textarea></td>
	  </tr>
	  
	  <tr>
        <td width="162" valign="top" nowrap="nowrap"><div align="right">Imagen:</div></td>
        <td colspan="2"><input name="upload" type="file" class="text_area" id="upload" size="60">
          &nbsp;&nbsp;&nbsp;&nbsp;Tamaño Max : 10M</td>
      </tr>
	  
	
      <tr>
        <td colspan="3"><br>
          <input name="option" value="{FORM_OPTION}" type="hidden">
		  <input name="old_passwd" type="hidden" id="old_passwd" value="{FORM_OLD_PASSWD}">
          <input name="section" value="{FORM_SECTION}" type="hidden">
          <input name="task" value="" type="hidden">
		  <input name="userid" id="userid" value="admin" type="hidden">
          <input name="iditem" type="hidden" id="iditem" value="<?php echo $row['id']; ?>">
          <input name="dirPath" type="hidden" id="dirPath" value="{FORM_DIR_PATH}">
          <input name="hidemainmenu" value="{FORM_HIDE_MAIN_MENU}" type="hidden"></td>
      </tr>
    </tbody>
  </table>
</form>
<!-- end form_users_edit.inc.htm -->
  </div>
</div>
