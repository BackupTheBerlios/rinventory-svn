<style>
.st_tbcss,.st_tdcss,.st_divcss,.st_ftcss{border:none;padding:0px;margin:0px}
A.st_acss,A.st_acss:link,A.st_acss:visited,A.st_acss:active,A.st_acss:hover{background-color:transparent;font-style:normal;border:none}
</style>
<!-- end top_menu.inc.htm -->
<!-- start toolbar.inc.htm -->

<table class="menubar" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td class="menudottedline" width="40%"><div class="pathway"><a href="index.php?pages=home" class="headerNavigation">Panel de Control</a> <?php echo SB_BREADCRUMB;?> <a href="index.php?pages=lote_list" class="headerNavigation">Lotes</a></div></td>
	<td class="menudottedline" align="right">
		<table id="toolbar" border="0" cellpadding="0" cellspacing="0">
		<tr align="center" valign="middle">
		<!-- start icons_toolbar_edit.inc.htm -->
			<!--<td><a class="toolbar" href="javascript:showMainMenu();if($F('items')==''){alert('Por favor elija el producto');} else if ($F('box')==''){alert('Por favor Ingrese la cantidad de cajas');} else if ($F('units')==''){alert('Ingrese el Número de unidades');} else{ submitbutton('save');}" onClick=""> <img src="img/sweb/save_f2.png" alt="Activo" name="active" align="middle" border="0"> <br>Guardar</a> </td>
			<td>&nbsp;</td>-->
			<td><a class="toolbar" href="javascript:history.go(-1)"> <img src="img/sweb/cancel_f2.png" alt="Nuevo" name="new" align="middle" border="0"> <br>Cancelar</a> </td>
			<td>&nbsp;</td>
		<!-- end icons_toolbar_edit.inc.htm -->
		</tr>
		</table>
	</td>
</tr>
</table>

<!-- end toolbar.inc.htm -->	<!-- start company.inc.htm -->
<script type="text/javascript">

function multiplicar(){
m1 = document.getElementById("box").value;
m2 = document.getElementById("units").value;
r = m1*m2;
document.getElementById("stock").value = r;
pf=document.getElementById("pricef").value;
if ((pf !='')||(pf>='0'))
sumar();
}
function sumar(){
res=parseInt(costo.value)+parseInt(tmar.value)+parseInt(tter.value)+parseInt(cade.value)+parseInt(other.value)+parseInt(aduana.value)+parseInt(tbank.value);
d1 = parseInt(stock.value);
r = (res / d1);
document.getElementById("pricef").value = r;

}
</script>
<div class="centermain" align="center">
	<div class="main">
	<!-- start form_departamentos_edit.inc.htm -->
		<table class="adminheading">
		<tr>
			<th class="categories"><img src="img/sweb/almacenes.png" width="48" height="48" name="logo_Departamentos" border="0" class="icon-png" alt="Departamentos"/> Lotes</th>
		</tr>
		</table>
		
		<form action="index.php?pages=lote" method="post" name="adminForm" enctype="multipart/form-data">
			<table class="adminform">
			<!--DWLayoutTable-->
			<tbody>
			<tr>
				<th colspan="3">Detalles</th>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Nombre:</div></td>
				<td>
					<select name="items" id="items" style="width:250px;" class="text_area" onchange="ReloadCat()">
					<option value=""></option>
<?php  	
$slc="selected='selected'";
$idalm = $_GET['id'];
$res = $db->query("SELECT * FROM ".TBL_LOT." WHERE id='$idalm'");
$row = $db->getRow($res, 0);
$chek = "";

if($row['active']==1)
	$chek="checked='checked'";  

$resc = $db->query("SELECT id,link_type_item as name,v_descr FROM ".TBL_ITEM);
while($rowc=$db->getRow($resc)){
?> 
					<option value="<?php echo $rowc['id'];?>" <?php if ($row['name']==$rowc['id']) echo $slc; ?> > <?php echo  $rowc['v_descr']; ?></option>
<?php
}
?>
					</select>
				</td>
				<td rowspan="9" valign="top"></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Cajas:</div></td>
				<td><input name="box" type="text" class="text_area" onchange="multiplicar()" id="box" value="<?php echo $row['cajas']?>" size="20"> <span class="obligatorio">*</span></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Unidades:</div></td>
				<td><input name="units" type="text" onchange="multiplicar()" class="text_area" id="units" value="<?php echo $row['unidades']?>"  size="20"> <span class="obligatorio">*</span></td>
			</tr>
			<tr>
				<td width="250" nowrap="nowrap"><div align="right">Stock:</div></td>
				<td><input name="stock" type="text"  class="text_area" readonly="readonly" id="stock" value="<?php echo $row['stock']?>" size="20"></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Activo:</div></td>
				<td><input name="active" <?php echo $chek;?> type="checkbox" id="active" value="1"></td>
			</tr>      
			<tr>
				<td width="250" nowrap="nowrap"><div align="right">Almacen</div></td>
				<td>
					<select name="almacen" id="almacen" style="width:250px;" class="text_area" onchange="ReloadCat()">
					<option value=""></option>
<?php
$resc = $db->query("Select id,name from dvd_departament");
while($rowc = $db->getRow(resc, 0)){
?> 
					<option value="<?php echo $rowc['id'];?>" <?php if ($rowc['id']==$row['idalmacen']) echo $slc; ?> > <?php echo $rowc['name']; ?></option>
<?php
}
?>
					</select>
				</td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Costo:</div></td>
				<td><input name="costo" onchange="sumar()" type="text" class="text_area" id="costo" value="<?php echo $row['costo']?>" size="30"> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Transporte Maritimo:</div></td>
				<td><input name="tmar" onchange="sumar()" type="text" class="text_area" id="tmar" value="<?php echo $row['tran_mar']?>" size="30"> <span class="obligatorio">*</span> </td>
			</tr>            
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Transporte Terrestre :</div></td>
				<td><input name="tter" onchange="sumar()" type="text" class="text_area" id="tter" value="<?php echo $row['tran_ter']?>" size="30"/> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Aduana :</div></td>
				<td><input name="aduana" onchange="sumar()" type="text" class="text_area" id="aduana" value="<?php echo $row['aduana']?>" size="30"/> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Transferencia Bancaria :</div></td>
				<td><input name="tbank" onchange="sumar()" type="text" class="text_area" id="tbank" value="<?php echo $row['trans_bank']?>" size="30"/> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Carguio / Desacargio :</div></td>
				<td><input name="cade" onchange="sumar()" type="text" class="text_area" id="cade" value="<?php echo $row['carga']?>" size="30"> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="250"><div align="right">Otros:</div></td>
				<td><input name="other" onchange="sumar()" type="text" class="text_area" id="other" value="<?php echo $row['otros']?>" size="30"> <span class="obligatorio">*</span> </td>
			</tr>
			<tr>
				<td width="250" nowrap="nowrap"><div align="right">Precio Final:</div></td>
				<td colspan="2"><input style="background-color:#DFDFDF" name="pricef" type="text" readonly="readonly" class="text_area" id="pricef" value="<?php echo $row['price_final']?>" size="20">  ( Precio final de compra) </td>
			</tr>
			<tr>
				<td width="250" rowspan="2" valign="top" nowrap="nowrap"><div align="right">Observaciones: </div></td>
				<td width="445" height="1"></td>
				<td></td>
			</tr>
			<tr>
				<td valign="top">
					<div class="htmlarea"><textarea name="notes" cols="45" rows="7" class="text_area" id="Description"><?php echo $row['obs']?></textarea></div>
				</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3"><br>
					<input name="option" value="com_departamentos" type="hidden">
					<input name="section" value="" type="hidden">
					<input name="task" value="" type="hidden">
					<input name="id" type="hidden" id="id" value="<?php echo $row['id']?>">
					<input name="hw" type="hidden" id="hw" value="modify">
					<input name="hidemainmenu" value="0" type="hidden">
				</td>
			</tr>
			</tbody>
			</table>
		</form>
	<!-- end form_departamentos_edit.inc.htm -->
	</div>
</div>
