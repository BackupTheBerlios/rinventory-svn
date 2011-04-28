<?php
require_once 'inc/class.mysqli.php';

$db = Database::getInstance();

if(isset($_GET['item']))
	$titem=$_GET['item'];
?>

<form action="index.php?pages=inventario&item=<?php echo $titem;?>&hw=mdf" method="post" name="adminForm" enctype="multipart/form-data">
	<table class="form">
	<tbody>
	<tr>
		<td class="label">Producto:</td>  
		<td>
			<select name="items" id="items">
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
		<td class="label">Nombre:</td>
		<td><input name="name" type="text" id="name" value="<?php echo $row['v_descr'];?>" size="25" maxlength="25"/> <span class="mandatory">*</span></td>
	</tr> 
<?php 

if($titem!="multiple"){
?>
	<tr>
		<td class="label">Material:</td>
		<td><input name="material" type="text" id="material" value="<?php echo $row['material'];?>" size="25" maxlength="25" /> <span class="mandatory">*</span></td>
	</tr>
<?php 
} 

if($titem=="stnd") { ?>
	<tr>
		<td class="label">Color:</td>
		<td>
			<select name="color" id="select">
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
		<td class="label">Espesor:</td>
		<td>
			<select name="espes" id="espes">
			<option value=""></option>
<?php  
	$resc=$db->query("Select * from dvd_spesor");

	while($rowc=$db->getRow($resc, 0)) {
?>
			<option value="<?php echo $rowc['name'];?>"  <?php if ($rowc['name']==$row['v_60_5']) echo $slc; ?> ><?php echo $rowc['name']; ?></option>
<?php
	}
?>
			</select> <span class="mandatory">*</span>
		</td>
	</tr>
<?php 
}
?>
	<tr>
	    <td class="label">Marca:</td>
	    <td>
			<select name="marker" id="select">	
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
		<td class="label">Regrabable:</td>
		<td><input name="regr" type="checkbox" id="regr" <?php echo $chek; ?> value="<?php echo $row['rewrite'];?>" /></td>
	</tr>
<?php 
	} 
?>
	<tr>
		<td class="label">Precio Unitario:</td>
		<td><input name="price_unit" type="text" id="price_unit" value="<?php echo $row['price_unit']; ?>" size="25" /> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Precio Paquete:</td>
		<td><input name="price_paq" type="text" id="price_paq" value="<?php echo $row['price_paq']; ?>" size="25" /> <span class="mandatory">*</span></td>
	</tr>
	<tr>
		<td class="label">Precio Caja:</td>
		<td><input name="price_box" type="text" id="price_box" value="<?php echo $row['price_box']; ?>" size="25" /> <span class="obligatorio">*</span></td>
	</tr>
	<tr>
		<td class="label">Stock M&iacute;nimo:</td>
		<td><input name="stockmin" type="text" id="stockmin" value="<?php echo $row['stock_min']; ?>" size="25"></td>
	</tr>
<?php 
	if($_GET['item'])
		$titem=$_GET['item'];
	
	if($titem=="normal"){
?>
	<tr>
		<td class="label">Para:</td>
		<td>
			<select name="spara" id="spara">
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
		<td class="label">Tipo Estuche:</td>
		<td>
			<select name="tstch" id="tstch">
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
		<td class="label">Velocidad:</td>
		<td>
			<select name="velocity" id="velocity">
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
		<td class="label">Paquete:</td>
		<td>
			<select name="paquete" id="paquete">
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
		<td class="label">Envase:</td>
		<td>
			<select name="envase" id="envase">
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
		<td class="label">Capacidad:</td>
		<td>
			<select name="capacidad" id="capacidad">
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
		<td class="label">Observaciones:</td>
		<td><textarea id="notas" rows="3" cols="43" name="notas"><?php echo $row['description']; ?></textarea></td>
	  </tr>
	  
	  <tr>
        <td class="label">Imagen:</td>
        <td colspan="2"><input name="upload" type="file" id="upload" size="60"> Tamaño Max : 2M</td>
      </tr>
    </tbody>
  </table>
	<br />
	<input name="option" value="{FORM_OPTION}" type="hidden">
	<input name="section" value="{FORM_SECTION}" type="hidden">
	<input name="task" value="" type="hidden">
	<input name="iditem" type="hidden" id="iditem" value="<?php echo $row['id']; ?>">
	<input name="dirPath" type="hidden" id="dirPath" value="{FORM_DIR_PATH}">
	<input name="hidemainmenu" value="{FORM_HIDE_MAIN_MENU}" type="hidden">
	<button id="save">Guardar</button>
</form>
<div id="dialog_error"><div class="error-list"></div></div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#save').button({
		icons:{primary: 'ui-icon-disk'}
	}).click(function(){
		if (checkData()){
			jQuery('#dialog_error .error-list').html('<?php echo ICON_ALERT;?>' + error);
			jQuery('#dialog_error').dialog('open');
			return false;
		}
	});
	jQuery('#dialog_error').dialog({
		autoOpen: false,
		modal: true,
		title: '<?php echo ERROR_TITLE; ?>',
		buttons: {
			'Aceptar': function(){jQuery(this).dialog("close")}
		}
	});
})

function checkData(){
	var error = '';

	if(!jQuery('#name').val())
		error += '<li>Por favor ingrese el Nombre</li>';

	if(!jQuery('#stockmin').val())
		error += '<li>Por favor ingrese el Stock M&iacute;nimo</li>';

	if (error)
		return '<ul>' + error + '</ul>';
}
</script>

