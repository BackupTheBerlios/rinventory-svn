<?php
require_once 'inc/class.mysql.php';
require_once 'inc/class.log.php';

class Store{
	public $id;
	public $name;
	public $phone;
	public $fax;
	public $contact;
	public $email;
	public $description;
	public $address;
	public $active;

	/**
	 * 
	 */
	private function setupSafeInput(){
		$log = Log::getInstance();
		
		$this->name = strip_tags($this->name);
		$this->phone = strip_tags($this->phone);
		$this->fax = strip_tags($this->fax);
		$this->contact = strip_tags($this->contact);
		$this->email = strip_tags($this->email);
		$this->description = strip_tags($this->description);
		$this->address = strip_tags($this->address);
		$this->active = ($this->active? 1 : 0);
		
		if (strlen($this->name) < 3)
			$log->addError("Nombre debe tener por lo menos 3 caracteres.");
	}
	
	/**
	 * 
	 * @param unknown_type $storeid
	 */
	public function read($storeid) {
		$db = Database::getInstance();
		
		$sql = "SELECT name,phone,fax,address,contact_name contact,active,email,description FROM ".TBL_DEPARTMENT." WHERE id=$storeid";
		
		$res = $db->query($sql);
		
		if ($db->rows($res) != 1)
			return false;
		
		$row = $db->getRow($res, 0); 
		$this->id = $storeid;
		$this->name = $row['name'];
		$this->phone = $row['phone'];
		$this->fax = $row['fax'];
		$this->contact = $row['contact'];
		$this->email = $row['email'];
		$this->active = $row['active'];
		$this->address = $row['address'];
		$this->description = $row['description'];
		
		return true;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function update(){
		$log = Log::getInstance();
		
		if (!is_numeric($this->id)){
			$log->addError("Entrada de Almacen no especificada.");
			return false;
		}
		
		$db = Database::getInstance();		
		$this->setupSafeInput();
		
		$sql = "UPDATE ".TBL_DEPARTMENT." SET ".
			"name='".$db->escape($this->name)."',".
			"contact_name='".$db->escape($this->contact)."',".
			"phone='".$db->escape($this->phone)."',".
			"active=$this->active,".
			"address='".$db->escape($this->address)."',".
			"fax='".$db->escape($this->fax)."',".
			"email='".$db->escape($this->email)."',".
			"description='".$db->escape($this->description)."' ".
			"WHERE id=$this->id";
		
		$res = $db->query($sql);
		
		if (!$res)
			$log->addError("No se pudo ejecutar actualizaci&oacute;n de datos.");

		return $res;
	}
	
	public function add(){
		return false;	
	}
	
	/**
	 * Returns an array with all active stores
	 */
	public static function getAllActive($sortField, $sortOrder=""){
		$db = Database::getInstance();
		$sortSql = "";
		$array = array();
		
		if ($sortField)
			$sortSql = "ORDER BY $sortField $sortOrder";
		
		$res = $db->query("SELECT id, name FROM ".TBL_DEPARTMENT." WHERE active=1 $sortSql");
		
		while($row = $db->getRow($res, 0)){
			$array[] = $row;
		}
		
		return $array;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $sourceLot
	 * @param unknown_type $targetStore
	 * @param unknown_type $quantity
	 * @param unknown_type $uid
	 */
	public static function transfer($sourceLot, $targetStore, $quantity, $uid){
		$db = Database::getInstance();
		$res = $db->query("SELECT * FROM ".TBL_LOT." WHERE id=$sourceLot AND active=1");
		
		if ($res){
			$lot = $db->getRow($res, 0);
			
			if ($lot['stock'] == $quantity){
				// full lot is sent to store
				$res = $db->query("UPDATE ".TBL_LOT." SET idalmacen=$targetStore,hw_updated=NOW(),by_modify=$uid WHERE id=$sourceLot");

				if (!$res)
					return false;
			}
			else if ($lot['stock'] > $quantity){
				$res = $db->query("INSERT INTO ".TBL_LOT." ".
					"(name,stock,active,idalmacen,costo,hw_added,by_added,by_modify,hw_updated,tran_mar,tran_ter,aduana,trans_bank,carga,otros,price_final,obs)".
					" VALUES ".
					"('{$lot['name']}',$quantity,1,$targetStore,{$lot['costo']},NOW(),$uid,$uid,NOW(),{$lot['tran_mar']},{$lot['tran_ter']},{$lot['aduana']},{$lot['trans_bank']},{$lot['carga']},{$lot['otros']},{$lot['price_final']},'');");
				
				if (!$res)
					return false;
				
				$res = $db->query("UPDATE ".TBL_LOT." SET stock=stock-$quantity,by_modify=$uid,hw_updated=NOW() WHERE id=$sourceLot");

				if (!$res)
					return false;
			}
			else
				return false;
		}
		else
			return false;
			
		return true;
	}
} 
?>
