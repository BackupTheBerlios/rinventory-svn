<?php
class User{
	public $id;
	public $firstname;
	public $lastname;
	public $level;
	public $active;
	public $email;
	public $username;
	public $password;
	public $ci;
	public $phone;
	public $imagepath;
	
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
	 * @param unknown_type $storeid
	 */
	public function add($storeid=0){
		$db = Database::getInstance();

		if (!$storeid)
			$storeid = "NULL";
			
		$res = $db->query("INSERT INTO ". TBL_USER ." ".
			"(name,ape,address,username,pwd,email,CI,active,hw_added,phone,link_departament,last_update,image)".
			" VALUES ".
			"('$this->firstname','$this->lastname','$this->address','$this->username','$this->password','$this->email','$this->ci','$this->active',NOW(),'$this->phone',$storeid,NOW(),'$this->imagepath')");
		
		if (!$res)
			return false;
		
		$this->id = $db->lastID();
		
		return true;
	}
}
?>