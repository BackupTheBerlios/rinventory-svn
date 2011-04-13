<?

//echo "name: ".$_POST['name'].' - '.$_POST['contact_name'].' - '.$_POST['active'];

$id=isset($_POST['id']) ? $_POST['id'] : -1;
$name = $_POST['name'];
$ape = $_POST['apellidos'];
$login = $_POST['login'];
$pwd = $_POST['passwd'];
$dci = $_POST['ci'];
$active = $_POST['active'];
$tipo = $_POST['roll'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$dep = $_POST['company'];
$email = $_POST['email'];
$upload =isset($_POST['upload']) ? $_POST['upload'] : ""; 

//echo "La imagen subio correctamente";
$ruta="";
	
if($_FILES['upload']['name']) {
	$ruta = "img/user/" . $_FILES['upload']['name'];  
	copy($_FILES['upload']['tmp_name'], $ruta); 
}
	 
if ($_POST['hw']){ 
	$res = $db->query("UPDATE ". TBL_USER ." SET ".
		"name='$name',".
		"ape='$ape',".
		"address='$address',".
		"username='$login',".
		"email='$email',".
		"ci='$dci',".
		"active='$active',".
		"phone='$phone',".
		"link_departament='$dep',".
		"last_update=NOW(),".
		"image='$ruta' WHERE id='$id'");	  
}
else{
	$res = $db->query("INSERT INTO ". TBL_USER ." ".
		"(name,ape,address,username,pwd,email,CI,active,hw_added,phone,link_departament,last_update,image)".
		"VALUES".
		"('$name','$ape','$address','$login','$pwd','$email','$dci','$active',NOW(),'$phone','$dep',NOW(),'$ruta')");
}
?>
<div class="centermain" align="center">
  <div class="main">
    <!-- start form_departamentos_edit.inc.htm -->
    <script language="JavaScript" src="js/overlib_mini.js" type="text/javascript"></script>
    
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
