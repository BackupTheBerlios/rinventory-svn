<?php
require_once 'inc/class.session.php';
require_once 'inc/class.store.php';
require_once 'inc/class.item.php';

$session = Session::getInstance();
?>



<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#fecha').datepicker();

	jQuery('#store_selector').change(function(){
		jQuery('#table_items tbody').empty();
	});
});

function addItem(){
	var itemData = JSON.parse(jQuery('#item_selector').val());
	var tableItems = jQuery('#table_items');
	alert(tableItems.find('tbody').length);
	tableItems.find('tbody').append('<tr><td></td>'+
			'<td>'+itemData.name+'</td>'+
			'<td><input type="text" value="" class="decimal"/></td></tr>');
}

function finalizar(){
var nf=document.getElementById("items").rows.length;
if(confirm('Esta seguro que desea concretar la venta? '))
{
var tabla = document.getElementById('items'); 
filas = tabla.getElementsByTagName('tr'); 
var cont= 0; 
var a_items = new Array() ;
var n_items = new Array() ;
nf=nf;
for (i=1; i<nf ; i++) 
{ 

  a_items[i]= tabla.rows[i].cells[1].name;
  n_items[i]= tabla.rows[i].cells[2].innerHTML; 
}

var arv = a_items.toString();
var cantit= n_items.toString();
    
document.adminForm.arv.value=arv;
document.adminForm.cantit.value=cantit;
document.adminForm.ptotal.value=document.adminForm.precio.value;
}
 
}
function cancelar(module){
document.location='index.php?pages='+module;
}
function volver(module){
document.location='index.php?pages='+module;
}
</script>
<!-- end toolbar.inc.htm -->
<!-- start company.inc.htm -->

<div class="centermain" align="center">
<div class="main">
	<!-- start form_users_edit.inc.htm -->
	<table class="adminheading">
	<tr>
		<th class="categories"><img src="img/sweb/proyectos.png" width="48" height="48" name="logo_{USER}" border="0" class="icon-png" alt="{USER}">&nbsp;Ventas</th>
	</tr>
	</table>
<?php 

 
?>

<form action="index.php?pages=venta" method="post" name="adminForm"  onSubmit="finalizar()" >
	<table>
	<tr>
		<td>Vendedor:</td>
		<td><?php echo $session->userinfo['name']." ".$session->userinfo['ape']; ?></td>
	</tr>
	<tr>
		<td>Fecha:</td>
		<td><input name="fecha" type="text" class="text_area" id="fecha" value="" size="12"></td>
	</tr>
	<tr>
		<td>Cliente:</td>
		<td><input name="cliente" type="text" class="text_area" id="cliente" value="" size="30"/></td>
		<td>NIT:</td>
		<td><input name="nit" type="text" class="text_area" id="nit" value="" size="10"></td>
	</tr>
	<tr>
		<td>Almacen:</td>
		<td><select id="store_selector">
			<option value="">-Seleccionar Almacen-</option>
			<?php
			$res = Store::getAllActive("a", "name");

			while($row = $db->getRow($res, 0)){
				echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
			}
			?>
			</select>
		</td>
	</tr>
	</table>
	
	
	
	
	<table class="adminlist">
	<tr>
		<th colspan="5"><div align="center">Formulario deVenta</div></th>
	</tr>
	<tr>	    
		<td nowrap="nowrap"><div align="right">Vendedor:</div></td>
		<td><?php echo $session->userinfo['name']." ".$session->userinfo['ape']; ?></td>							
		<td><div align="right">Fecha:</div></td>
		<td></td>
	</tr>
	<tr>
		<td nowrap="nowrap" width="162"><div align="right">Cliente:</div></td>
		<td><input name="cliente" type="text" class="text_area" id="cliente" value="" size="50"><a href="javascript:clientes()">Clientes</a></td>
		<td width="150"><div align="right">NIT:</div></td>
		<td><input name="nit" type="text" class="text_area" id="nit" value="" size="23"></td>
	</tr>
	<tr>
		<td nowrap="nowrap"><div align="right">&nbsp;</div></td>
		<td nowrap="nowrap"><div align="right">&nbsp;</div></td>
		<td nowrap="nowrap" width="162"><div align="right">Estado:</div></td>
		<td><select name="ppago" id="ppago" style="width:150px;" class="text_area"><option value="P">Pendiente</option></select></td>						
	</tr>	
	<tr>
		<td colspan="11"><br/>
			<select id="store_selector">
			<option value="">-Seleccionar Almacen-</option>
			<?php
			$res = Store::getAllActive("a", "name");

			while($row = $db->getRow($res, 0)){
				echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
			}
			?>
			</select>
			<select id="item_selector">
			<option value="">-Seleccionar Producto-</option>
			<?php
			
			$res = Item::getAll("a", "name");
			
			while ($row = $db->getRow($res, -1)){
				echo "<option value=\"".htmlentities(json_encode($row))."\">{$row['name']}</option>";
			} 
			?>
			</select>
			<input type="button" value="A&ntilde;adir" onclick="addItem()"/>
			<table id="table_items">
			<thead>
			<tr>
				<th><div align="center" class="Estilo3 Estilo4">N&ordm;</div></th>
				<th width="250"><div align="center" class="Estilo6">Descripci&oacute;n</div></th>
				<th width="30"><div align="center" class="Estilo6">Cantidad</div></th>
            <th width="30"><div align="center" class="Estilo6">U/P</div></th>
            <th width="100"><div align="center" class="Estilo6">Total</div></th>
			</tr>
			</thead>
			<tbody></tbody>
			</table>
		</td>
	</tr>	  
	</table>
</form>
<!-- end form_users_edit.inc.htm -->
</div>
</div>
