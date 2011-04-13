<?php
require_once 'inc/init.php';
require_once 'inc/class.session.php';

$session = Session::getInstance();

if (isset($_POST['sub_login'])){
	// log in
	$retval = $session->login($_POST['username'], $_POST['passwd'], false);

	if($retval){
		// login success
		header("Location: ".$session->referrer);
	}
	else{
		// login failed
		$_SESSION['value_array'] = $_POST;
		$_SESSION['error_array'] = $form->getErrorArray();
		header("Location: ".$session->referrer);
	}
}
else {
	//log out
	$retval = $session->logout();
	header("Location: index.php");
}
?>