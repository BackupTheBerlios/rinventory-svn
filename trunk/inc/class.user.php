<?php
class User{
	public $id;
	public $firstname;
	public $lastname;
	public $level;
	public $active;
	public $email;
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function read($id){
		$db = Database::getInstance();
		$sql = "SELECT name,ape FROM ".TBL_USER." WHERE id=$id";
		$res = $db->query($sql);
		
		if ($db->rows($res) != 1)
			return false;
		
		$row = $db->getRow($res, 0);
		$this->id = $id;
		$this->firstname = $row['name'];
		$this->lastname = $row['ape'];
		$this->level = $row['level'];
		$this->email = $row['email'];
		
		return true;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $action
	 */
	public function isAllowed($action){
		return true;
	}
}
?>