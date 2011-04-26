<?php
require_once 'inc/class.user.php';
require_once 'inc/class.log.php';

function user_add(){
	$log = Log::getInstance();
	$user = new User();
	$storeid = isset($_POST['store']) ? $_POST['store'] : 0;
	
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
	
	if($user->add($storeid)){
		if($_FILES['upload']['name']) {
			$imagepath = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF'])."img/user/$$user->id.jpg";
			
			if(move_uploaded_file($_FILES['upload']['tmp_name'], $imagepath)){
				$user->imagepath = $imagepath;
				$user->update();
			}
			else
				$log->addError("No fue posible subir imagen");
		}
		
		header("Location: index.php?pages=user_detail&user=$user->id");
	}
	else
		$log->addError("No fue posible agregar usuario, verifique que Usuario sea &uacute;nico.");
}

function user_edit(){
	$log = Log::getInstance();
	$user = new User();
	$storeid = isset($_POST['store']) ? $_POST['store'] : 0;
	
	$user->id = isset($_POST['user']) ? $_POST['user'] : "";
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
	
	if($user->update()){
		if($_FILES['upload']['name']) {
			$imagepath = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF'])."img/user/$$user->id.jpg";
			
			if(move_uploaded_file($_FILES['upload']['tmp_name'], $imagepath)){
				$user->imagepath = $imagepath;
				$user->update();
			}
			else
				$log->addError("No fue posible subir imagen");
		}
	}
	else
		$log->addError("No fue posible actualizar usuario, verifique que Usuario sea &uacute;nico.");
}
?>