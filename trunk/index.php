<?phprequire_once 'inc/init.php';require 'inc/lang-es.php';require_once 'inc/class.session.php';require_once 'inc/class.mysqli.php';$db = Database::getInstance();$session = Session::getInstance();if($session->logged_in){	include 'options/header.php';	require 'inc/process/form.php';		process_form();		if(isset($_GET['option']))
		include 'tpl/'.$_GET['option'].'.htm';
	else if (isset($_GET['pages']))
		include 'options/'.$_GET['pages'].'.php';
	else
		include 'options/home.php';			include 'options/footer.php';
}		   
else	 
	include 'options/login.php';$db->close();
?>