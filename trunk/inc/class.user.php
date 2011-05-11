<?php
require_once 'inc/class.mysqli.php';

class User{
	public $id;
	public $firstname = "";
	public $lastname = "";
	public $level = 0;
	public $active = 1;
	public $email = "";
	public $username = "";
	public $password = "";
	public $ci = "";
	public $phone = "";
	public $address = "";
	public $imagepath = "";
	public $storeid = "";

	/**
	 * 
	 */
	private function setupSafeText($db){
		$this->firstname = $db->escape(strip_tags($this->firstname));
		$this->lastname = $db->escape(strip_tags($this->lastname));
		$this->address = $db->escape(strip_tags($this->address));
		$this->username = $db->escape(strip_tags($this->username));
		$this->email = $db->escape(strip_tags($this->email));
		$this->ci = $db->escape(strip_tags($this->ci));
		$this->phone = $db->escape(strip_tags($this->phone));
		$this->ci = $db->escape(strip_tags($this->ci));
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function read($id){
		$db = Database::getInstance();
		$sql = "SELECT name,ape,level,address,username,email,ci,phone,active,link_departament storeid FROM ".TBL_USER." WHERE id=$id";
		$res = $db->query($sql);
		
		if ($db->rows($res) != 1)
			return false;
		
		$row = $db->getRow($res, 0);
		$this->id = $id;
		$this->firstname = $row['name'];
		$this->lastname = $row['ape'];
		$this->address = $row['address'];
		$this->level = $row['level'];
		$this->email = $row['email'];
		$this->ci = $row['ci'];
		$this->phone = $row['phone'];
		$this->active = $row['active'];
		$this->username = $row['username'];
		$this->storeid = $row['storeid'];
		$db->dispose($res);
		
		return true;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $storeid
	 */
	public function add($storeid=0){
		$db = Database::getInstance();

		$this->setupSafeText($db);
		if (!$storeid)
			$storeid = "NULL";
			
		$sql = "INSERT INTO ". TBL_USER ." ".
			"(name,ape,".
			"address,username,".
			"pwd,email,".
			"CI,active,".
			"hw_added,last_update,".
			"phone,level,".
			"link_departament,image)".
			" VALUES ".
			"('".$db->escape($this->firstname)."','".$db->escape($this->lastname)."',".
			"'".$db->escape($this->address)."','".$db->escape($this->username)."',".
			"'".$db->escape($this->password)."','".$db->escape($this->email)."',".
			"'".$db->escape($this->ci)."',$this->active,".
			"NOW(),NOW(),".
			"'".$db->escape($this->phone)."',$this->level,".
			"$storeid,'$this->imagepath')";

		$res = $db->query($sql);
		
		if (!$res)
			return false;
		
		$this->id = $db->lastID();
		
		return true;
	}
	
	/**
	 * 
	 */
	public function update(){
		$db = Database::getInstance();
		
		$this->setupSafeText($db);
		
		$sql = "UPDATE ".TBL_USER." SET ".
			"name='$this->firstname',".
			"ape='$this->lastname',".
			"username='$this->username',".
			"address='$this->address',".
			($this->password ? "pwd='$this->password'," : "").
			"email='$this->email',".
			"CI='$this->ci',".
			"active=$this->active,".
			"phone='$this->phone',".
			"link_departament=".($this->storeid ? $this->storeid : "NULL").",".
			"level=$this->level,".
			"last_update=NOW(),".
			"image='$this->imagepath' ".
			"WHERE id=$this->id";
		
		return $db->query($sql);
	}
	
	/**
	 * 
	 */
	public static function getAll(){
		$db = Database::getInstance();
	
		$sql = "SELECT id,name firstname,ape lastname,address,username,email,active,phone FROM ".TBL_USER;
		$res = $db->query($sql);
		$array = array();
		$row = $db->getRow($res);

		while($row){
			$array[] = $row;
			$row = $db->getRow($res);
		}
		
		$db->dispose($res);
		
		return $array;
	}
}
?>