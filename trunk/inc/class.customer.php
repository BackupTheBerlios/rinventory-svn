<?php
include_once 'inc/class.mysqli.php';
include_once 'inc/class.log.php';

class Customer{
	public $id;
	public $name;
	public $address;
	public $phone;
	public $cell;
	public $nit;
	public $email;
	public $active;
	public $country;
	public $city;
	
	private function setupSafeInput(){
		$db = Database::getInstance();
		
		$this->name = $db->escape(strip_tags($this->name));
		$this->address = $db->escape(strip_tags($this->address));
		$this->phone = $db->escape(strip_tags($this->phone));
		$this->cell = $db->escape(strip_tags($this->cell));
		$this->email = $db->escape(strip_tags($this->email));
		$this->nit = $db->escape(strip_tags($this->nit));
		$this->active = $this->active ? 1 : 0;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $customerid
	 */
	public function read($customerid){
		$log = Log::getInstance();
		$db = Database::getInstance();
		$sql = "SELECT name,address,phone,cell,nit,email,active,date_created,date_modified FROM ".TBL_CUSTOMER." WHERE id=$customerid";
		$res = $db->query($sql);
		
		if (!$res){
			$log->addError("No se puedo obtener datos de cliente.");
			return false;
		}
		
		if ($db->rows($res) != 1){
			$log->addError("No se encontraron datos de cliente solicitado.");
			$db->dispose($res);
			return false;
		}
		
		$row = $db->getRow($res);
		$this->id = $customerid;
		$this->name = $row['name'];
		$this->address = $row['address'];
		$this->phone = $row['phone'];
		$this->cell = $row['cell'];
		$this->nit = $row['nit'];
		$this->email = $row['email'];
		$this->active = $row['active'];
		$db->dispose($res);
		
		return true;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function add(){
		$log = Log::getInstance();
		$db = Database::getInstance();
		
		$this->setupSafeInput();
		$sql = "INSERT INTO ".TBL_CUSTOMER." ".
			"(name,address,".
			"phone,cell,".
			"nit,active,".
			"email,date_created,date_modified)".
			" VALUES ".
			"('$this->name','$this->address',".
			"'$this->phone','$this->cell',".
			"'$this->nit',$this->active,".
			"'$this->email',NOW(),NOW())";
		
		$res = $db->query($sql);
		
		if (!$res){
			$log->addError("No se pudo agregar Cliente");
			return false;
		}
		
		$this->id = $db->lastID();
		return true;
	}
}
?>