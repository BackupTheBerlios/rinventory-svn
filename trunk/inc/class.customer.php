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
	public $country;
	public $city;
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $customerid
	 */
	public function read($customerid){
		$db = Database::getInstance();
		$sql = "SELECT name,address,phone,cell,nit FROM ".TBL_CUSTOMER." WHERE id=$customerid";
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
		$db->dispose($res);
		
		return true;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function add(){
		
	}
}
?>