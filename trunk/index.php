<?php
require_once 'inc/init.php';
require_once 'inc/class.session.php';


$db = Database::getInstance();
$login = Login::getInstance();
$session = Session::getInstance();

include 'options/header.php';

if($session->logged_in){
	if(isset($_GET['option']))
		include 'tpl/'.$_GET['option'].'.htm';
	else if (isset($_GET['pages']))
		include 'options/'.$_GET['pages'].'.php';
	else
		include 'tpl/home.htm';
}		   
else	 
	include 'options/login.php';

include 'tpl/footer.htm';

/*require_once 'inc/init.php';
require_once 'inc/class.mysql.php';
//require_once 'inc/class.login.php';
require 'acceso.php';

$db = Database::getInstance();
//$login = Login::getInstance();

include 'options/header.php';

$log = new Login();

if(isset($_POST['username'])){
	$us=$_POST['username'];
	$pwd=$_POST['passwd'];
	$log->Login_($us,$pwd);
}

if($log->IsLogin()){
	if(isset($_GET['option']))
		include 'tpl/'.$_GET['option'].'.htm';
	else if (isset($_GET['pages']))
		include 'options/'.$_GET['pages'].'.php';
	else
		include 'tpl/home.htm';
}		   
else	 
	include 'Login.htm'; 

include 'tpl/footer.htm'; 
 */ 
?>