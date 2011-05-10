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
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function update(){
		$log = Log::getInstance();
		$db = Database::getInstance();		
		
		$this->setupSafeInput();
		$sql = "UPDATE ".TBL_CUSTOMER." SET ".
			"name='$this->name',".
			"address='$this->address',".
			"phone='$this->phone',".
			"cell='$this->cell',".
			"nit='$this->nit',".
			"active=$this->active,".
			"email='$this->email',".
			"date_modified=NOW() ".
			"WHERE id=$this->id";
		
		if (!$db->query($sql)){
			$log->addError("No se pudo actualizar datos de Cliente.");
			return false;
		}
		
		return true;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $field
	 */
	public static function isField($field){
		$field = strtolower($field);
		
		switch ($field) {
			case "name":
			case "phone":
			case "address":
			case "cell":
			case "active":
			case "nit":
			case "email":
			case "date_modified":
			case "date_created":
				return true;
		}
		
		return false;
	}
	
	public static function fieldName($field){
		switch ($field) {
			case "name":
				return "name";
			case "phone":
				return "phone";
			case "address":
				return "address";
			case "cell":
				return "cell";
			case "active":
				return "active";
			case "nit":
				return "nit";
			case "email":
				return "email";
			case "date_modified":
				return "date_modified";
			case "date_created":
				return "date_created";
		}
		
		return "";
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $sortField
	 * @param unknown_type $sortOrder
	 */
	public static function getAll($sortField, $sortOrder){
		$db = Database::getInstance();
		$sortSql = $sortField ? " ORDER BY $sortField $sortOrder" : "";
		$sql = "SELECT id,name,address,phone,cell,email,nit,active FROM ".TBL_CUSTOMER.$sortSql;
		$array = array();
		$res = $db->query($sql);
		
		if (!$res){
			return $array;
		}
		
		$row = $db->getRow($res);
		
		while($row){
			$customer = new Customer();
			$customer->id = $row['id'];
			$customer->name = $row['name'];
			$customer->address = $row['address'];
			$customer->phone = $row['phone'];
			$customer->cell = $row['cell'];
			$customer->email = $row['email'];
			$customer->nit = $row['nit'];
			$customer->active = $row['active'];
			$array[] = $customer;
			$row = $db->getRow($res);	
		}
		
		$db->dispose($res);
		
		return $array;
	}
	
/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $sortField
	 * @param unknown_type $sortOrder
	 */
	public static function getAllActive($sortField, $sortOrder){
		$db = Database::getInstance();
		$sortSql = $sortField ? " ORDER BY $sortField $sortOrder" : "";
		$sql = "SELECT id,name,address,phone,cell,email,active FROM ".TBL_CUSTOMER." WHERE active=1".$sortSql;
		$array = array();echo $sql;
		$res = $db->query($sql);
		
		if (!$res){
			return $array;
		}
		
		$row = $db->getRow($res);
		
		while($row){
			$customer = new Customer();
			$customer->id = $row['id'];
			$customer->name = $row['name'];
			$customer->address = $row['address'];
			$customer->phone = $row['phone'];
			$customer->cell = $row['cell'];
			$customer->email = $row['email'];
			$customer->active = $row['active'];
			$array[] = $customer;
			$row = $db->getRow($res);	
		}
		
		$db->dispose($res);
		
		return $array;
	}
}
?>