<?phprequire_once 'inc/init.php';require_once 'inc/class.session.php';$session = Session::getInstance();if($session->logged_in){	include 'options/header.php';		if(isset($_GET['option']))
		include 'tpl/'.$_GET['option'].'.htm';
	else if (isset($_GET['pages']))
		include 'options/'.$_GET['pages'].'.php';
	else
		include 'options/home.php';			include 'options/footer.php';
}		   
else	 
	include 'options/login.php';
?>