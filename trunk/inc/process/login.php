<?php
require_once 'inc/init.php';
require_once 'inc/class.session.php';
require_once 'inc/class.log.php';

/**
 * 
 * Enter description here ...
 */
function sign_in(){
	$session = Session::getInstance();
	$retval = $session->login($_POST['username'], $_POST['passwd'], false);

	if($retval){
		// login success
		header("Location: ".$session->referrer);
		exit;
	}
	
	return false;
}
?>