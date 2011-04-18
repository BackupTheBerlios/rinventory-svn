<?php
require_once 'inc/class.mysql.php';

$db = Database::getInstance(); 
$titem = "";

if(isset($_GET['item']))
	$titem = $_GET['item'];			  
?>
<p class="form-title">Registo de Nuevo Producto</p>
<form action="index.php?pages=inventario&item=<?php echo $titem;?>" method="post" name="adminForm" enctype="multipart/form-data">
	<table class="form">
	<tbody>
	<tr>
		<td class="label">Producto:</td>
		<td>
			<select name="items" id="items" onchange="ReloadCat()">
			<option value=""></option>
<?php  	
$prod = "";

if (isset($_GET['item']))
	$titem=$_GET['item'];
			  
if (isset($_GET['prod'])){
	$slc="selected='selected'";
	$prod=$_GET['prod'];
}
//if($_GET['item'])
//   $titem=$_GET['item'];

$res = $db->query("SELECT id,name FROM ".TBL_ITEM_TYPE);

while($row=$db->getRow($res, 0)){
?> 
		<option value="<?php echo $row['name'];?>" <?php if ($row['name']==$prod) echo $slc; ?>> <?php echo $row['name']; ?></option>
<?php
}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label">Nombre:</td>
		<td><input name="name" type="text" id="name" value="" size="25" maxlength="25"/> <span class="mandatory">*</span> </td>
	</tr>
<?php 
if($titem!="multiple"){
?>
	<tr>
		<td class="label">Material:</td>
		<td><input name="material" type="text" id="material" value="" size="25" maxlength="25" /> <span class="mandatory">*</span></td>
	</tr>
<?php 
if($titem=="normal"){ ?>
	<tr>
		<td class="label">Espesor:</td>
		<td><select name="espes" id="espes">
<?php
	$res = $db->query("SELECT * FROM ".TBL_SPESOR);
	
	while($row = $db->getRow($res, 0)){
?>
			<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?></option>
<?php
}
?>
			</select>
		</td>
	</tr>
<?php 
} else {
?>
	<tr>
		<td class="label">Color:</td>
		<td>
			<select name="color" id="select">
			<option value="">&nbsp;</option>
<?php
$res = $db->query("SELECT * FROM ".TBL_COLOR);

while($row = $db->getRow($res, 0)){
?>
			<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?></option>
<?php
}
?>
			</select>	 
		</td>
	</tr>
<?php 
} //end if
}		
?>
	<tr>
		<td class="label">Marca:</td>
		<td>
			<select name="marker" id="select">
<?php  
$res = $db->query("SELECT name FROM ".TBL_MARKER);

while($row = $db->getRow($res, 0)){
?>
			<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?></option>
<?php
}
?>
			</select>
		</td>
	</tr>
<?php 
if($titem=="multiple"){
?>
	<tr>
		<td class="label">Regrabable:</td>
		<td><input name="regr" type="checkbox" id="regr" value="1"></td>
	</tr>
<?php 
} 
?>
	<tr>
		<td class="label">Precio Unitario:</td>
		<td><input name="price_unit" type="text" id="price_unit" value="" size="25" /> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Precio Paquete:</td>
		<td><input name="price_paq" type="text" id="price_paq" value="" size="25" /> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Precio Caja:</td>
		<td><input name="price_box" type="text" id="price_box" value="" size="25" /> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Stock M&iacute;nimo:</td>
		<td><input name="stockmin" type="text" id="stockmin" value="" size="25" /> <span class="mandatory">*</span></td>
	</tr>
<?php 
if($titem=="normal"){
?>
	<tr>
		<td class="label">Para:</td>
		<td>
			<select name="spara" id="spara">
<?php
	$res = $db->query("SELECT * FROM ".TBL_FOR);
	
	while($row = $db->getRow($res, 0)) {
?>
			<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?></option>
<?php
	}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label">Tipo Estuche:</td>
		<td>
			<select name="tstch" id="tstch">
<?php
	$res = $db->query("SELECT * FROM dvd_type_stch");
	
	while($row = $db->getRow($res, 0)){
?>
			<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?></option>
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
		<td class="label">Velocidad:</td>
		<td>
			<select name="velocity" id="velocity">
<?php
	$res = $db->query("SELECT * FROM ".TBL_VELOCITY);
	
	while($row = $db->getRow($res, 0)) {
?>
			<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?></option>
<?php
	}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label">Paquete:</td>
		<td>
			<select name="paquete" id="paquete">
<?php 
	$res = $db->query("SELECT * FROM ".TBL_PACKAGE);
	
	while($row = $db->getRow($res, 0)){
?>
			<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?></option>
<?php
	}
?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="label">Envase:</td>
		<td>
			<select name="envase" id="envase">
<?php
	$res = $db->query("SELECT * FROM dvd_envase");
	
	while($row = $db->getRow($res, 0)) {
?>
			<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?></option>
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
		<td class="label">Capacidad:</td>
		<td>
			<select name="capacidad" id="capacidad">
<?php
	$res = $db->query("SELECT name FROM dvd_capacity ORDER BY name");
	
	while($row = $db->getRow($res, 0)) {
?>
			<option value="<?php echo $row['name'];?>"><?php echo $row['name']; ?></option>
<?php
	}
 ?>
			</select>
		</td>
	</tr>
<?php } ?>
	<tr>
		<td class="label">Observaciones:</td>
		<td><textarea id="notas" rows="3" cols="43" name="notas"></textarea></td>
	</tr>
	<tr>
		<td class="label"><div align="right">Imagen:</div></td>
		<td colspan="2"><input name="upload" type="file" id="upload" size="60"> &nbsp;Tama&ntilde; Max: 2M</td>
	</tr>
	</tbody>
	</table>
	<br />
	<button id="save">Guardar</button>
</form>
<div id="dialog_error"><div class="error-list"></div></div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#save').button({
		icons:{primary: 'ui-icon-disk'}
	}).click(function(){
		var error = checkData(); 

		if (error){
			jQuery('#dialog_error .error-list').html('<span class="ui-icon ui-icon-alert"></span>' + error);
			jQuery('#dialog_error').dialog('open');
			return false;
		}
	});
	jQuery('#dialog_error').dialog({
		autoOpen: false,
		modal: true,
		title: 'Se detectaron Errores!',
		buttons: {
			'Aceptar': function(){jQuery(this).dialog("close")}
		}
	});
});

function checkData(){
	var error = '';
	
	if(!jQuery('#name').val())
		error += '<li>Debe introducir Nombre</li>';

	if(!jQuery('#stockmin').val())
		error += '<li>Debe introducir Stock Mínimo</li>';

	if (error)
		error = '<ul>' + error + '<ul>';

	return error;
}

function ReloadCat(){	
	var f=document.adminForm;
	var prod=f.items.options[f.items.selectedIndex].text;
	
	if (prod=='Dvd-cd')
		document.location='<?php echo SITE_URL;?>index.php?pages=inventario_new&item=multiple&prod='+prod;
	else {
		if (prod=='Estuches')
			document.location='<?php echo SITE_URL;?>index.php?pages=inventario_new&item=normal&prod='+prod;
		else 
			document.location='<?php echo SITE_URL;?>index.php?pages=inventario_new&item=stnd&prod='+prod;
	}
}

</script>