<?php
require_once 'inc/class.user.php';

function userAdd(){
	$user = new User();
	$storeid = isset($_POST['store']) ? $_POST['store'] : 0;
	$imagepath = "";
	
	if($_FILES['upload']['name']) {
		$path = "img/user/" . $_FILES['upload']['name'];  
		copy($_FILES['upload']['tmp_name'], $path); 
	}
	
	$user->firstname = isset($_POST['firstname']) ? $_POST['firstname'] : "";
	$user->lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
	$user->username = isset($_POST['username']) ? $_POST['username'] : "";
	$user->password = isset($_POST['passwd']) ? $_POST['passwd'] : "";
	$user->ci = isset($_POST['ci']) ? $_POST['ci'] : "";
	$user->active = isset($_POST['active']);
	$user->level = isset($_POST['role']) ? $_POST['role'] : 0;
	$user->address = isset($_POST['address']) ? $_POST['address'] : "";
	$user->phone = isset($_POST['phone']) ? $_POST['phone'] : "";
	$user->email = isset($_POST['email']) ? $_POST['email'] : "";
	$user->imagepath = $imagepath;
	
	if($user->add($storeid))
			
}
?>