<?php
require_once 'inc/class.mysqli.php';
require_once 'inc/class.session.php';
require_once 'inc/class.log.php';

class PurchaseDetail {
	public $purchaseid;
	public $line;
	public $description;
	public $price;
	public $quantity;
	
	public static function getAll($purchaseid){
		$db = Database::getInstance();
		$array = array();
		$sql = "SELECT line,description,quantity,price FROM ".TBL_PURCHASE_DETAIL." WHERE purchaseid=$purchaseid";
		$res = $db->query($sql);
		
		if (!$res)
			return $array;
			
		$row = $db->getRow($res);
		 
		while($row){
			$detail = new PurchaseDetail();
			$detail->line = $row['line'];
			$detail->description = 	$row['description'];
			$detail->price = $row['price'];
			$detail->quantity = $row['quantity'];
			$array[] = $detail;
			$row = $db->getRow($res);
		}
		
		$db->dispose($res);
		
		return $array;
	}
}

class PurchasePayment {
	public $purchaseid;
	public $line;
	public $amount;
	public $date;
	public $createdBy;
	public $updatedBy;
	
	/**
	 * 
	 */
	public function add(){
		$db = Database::getInstance();
		$session = Session::getInstance();
		$log = Log::getInstance();
		$user = $db->escape($session->userinfo['firstname']." ".$session->userinfo['lastname']);
		
		$db->startTransaction();
		$sql = "SELECT MAX(line)+1 newline FROM ".TBL_PURCHASE_PAYMENT." WHERE purchaseid=$this->purchaseid";
		$res = $db->query($sql);
		$row = $db->getRow($res);
		$newline = $row['newline'];
		
		$sql = "INSERT INTO ".TBL_PURCHASE_PAYMENT." ".
			"(purchaseid,line,amount,`date`,created_by,updated_by)".
			" VALUES ".
			"($this->purchaseid,$newline,$this->amount,NOW(),'$user','$user')";

		$db->dispose($res);
		$res = $db->query($sql);
		
		if (!$res){
			$db->rollback();
			$log->addError("No se pudo agregar pago.");
			return false;
		}
		
		// Check amount
		$sql = "SELECT p.amount, ".
			"(SELECT SUM(pp.amount) FROM ".TBL_PURCHASE_PAYMENT." pp WHERE pp.purchaseid=$this->purchaseid) paid ".
			"FROM ".TBL_PURCHASE." p WHERE p.id=$this->purchaseid";
		
		$res = $db->query($sql);
		
		if (!$res){
			$db->rollback();
			$log->addError("No se pudo agregar pago, no es posible verificar datos introducidos.");
			return false;
		}
		
		$row = $db->getRow($res);
		$db->dispose($res);
		
		if ($row['paid'] > $row['amount']){
			$db->rollback();
			$log->addError("No se pudo agregar pago, monto introducido excede total de la compra.");
			return false;
		}
		
		if (!$db->commit())
			return false;
		
		$this->line = $newline;
		
		return true;
	}
	
	/**
	 * 
	 * @param unknown_type $purchaseid
	 */
	public static function getAll($purchaseid){
		$db = Database::getInstance();
		$array = array();
		$sql = "SELECT line,date,amount,created_by,updated_by FROM ".TBL_PURCHASE_PAYMENT." WHERE purchaseid=$purchaseid";
		$res = $db->query($sql);
		
		if (!$res)
			return $array;
		
		$row = $db->getRow($res);
			
		while($row){
			$ppayment = new PurchasePayment();
			$ppayment->purchaseid = $purchaseid;
			$ppayment->line = $row['line'];
			$ppayment->amount = $row['amount'];
			$ppayment->date = $row['date'];
			$ppayment->createdBy = $row['created_by'];
			$ppayment->updatedBy = $row['updated_by'];
			$array[] = $ppayment;
			$row = $db->getRow($res);
		}
		
		$db->dispose($res);
		
		return $array;
	}
}

class Purchase{
	public $id;
	public $code;
	public $date;
	public $prepayment;
	public $provider;
	public $gloss;
	public $dateCreated;
	public $dateModified;
	public $createdBy;
	public $updatedBy;
	public $status;
	public $amount;
	public $outstanding;
	public $detail = array();
	
	/**
	 * 
	 */
	public function Add(){
		$db = Database::getInstance();
		$session = Session::getInstance();
		$log = Log::getInstance();
		$amount = 0;
		$res = false;
		$purchased_by = $db->escape($session->userinfo['firstname']." ".$session->userinfo['lastname']);
		
		foreach ($this->detail as $detail){
			$amount += ($detail->price * $detail->quantity);	
		}
		
		$sql = "INSERT INTO ".TBL_PURCHASE." ".
			"(code,`date`,date_created,date_modified,".
			"provider,amount,prepayment,".
			"gloss,status,".
			"created_by,updated_by)".
			" VALUES ".
			"('$this->code','$this->date',NOW(),NOW(),".
			"'".$db->escape($this->provider)."',$amount,$this->prepayment,".
			"'".$db->escape($this->gloss)."',".PURCHASE_STATUS_PENDING.",".
			"'$purchased_by','$purchased_by')";
		
		$db->startTransaction();
		$res = $db->query($sql);
		
		if (!$res){
			$db->rollback();
			$log->addError("No se puedo agregar Compra, verifique los datos ingresados, el c&oacute;digo no debe repetirse.");
			return false;
		}
		
		$purchaseid = $db->lastID();
		
		if ($this->prepayment > 0){
			$sql = "INSERT INTO ".TBL_PURCHASE_PAYMENT." (purchaseid,line,`date`,amount,created_by,updated_by)".
				" VALUES ".
				"($purchaseid,1,NOW(),$this->prepayment,'$purchased_by','$purchased_by')";
			
			$res = $db->query($sql);
			
			if (!$res){
				$db->rollback();
				$log->addError("Problemas para agregar el anticipo de Compra especificado.");
				return false;
			}
		}
		
		foreach($this->detail as $detail){
			$sql = "INSERT INTO ".TBL_PURCHASE_DETAIL." (purchaseid,line,description,quantity,price)".
				" VALUES ".
				"($purchaseid,$detail->line,'$detail->description',$detail->quantity,$detail->price)";
			
			$res = $db->query($sql);
			
			if (!$res){
				$db->rollback();
				$log->addError("Problemas para agregar el detalle de Compra especificado.");
				return false;
			}
		}
		
		if(!$db->commit())
			return false;
			
		$this->id = $purchaseid;
		
		return true;
	}
	
	
	/**
	 * 
	 */
	public function update(){
		$db = Database::getInstance();
		$session = Session::getInstance();
		$updated_by = $db->escape($session->userinfo['firstname']." ".$session->userinfo['lastname']);
		$sql = "UPDATE ".TBL_PURCHASE." SET ".
			"status=$this->status,".
			"updated_by='$updated_by',".
			"date_modified=NOW() ".
			"WHERE id=$this->id";
		
		return $db->query($sql);
	}
	
	/**
	 * 
	 * @param unknown_type $purchaseid
	 */
	public function read($purchaseid){
		$db = Database::getInstance();
		
		$sql = "SELECT code,`date`,provider,gloss,amount,prepayment,date_modified,date_created,created_by,updated_by,status FROM ".TBL_PURCHASE." WHERE id=$purchaseid";

		$res = $db->query($sql);
		
		if ($db->rows($res) != 1)
			return false;
			
		$row = $db->getRow($res, 0);
		$this->id = $purchaseid;
		$this->code = $row['code'];
		$this->date = $row['date'];
		$this->gloss = $row['gloss'];
		$this->prepayment = $row['prepayment'];
		$this->provider = $row['provider'];
		$this->dateCreated = $row['date_created'];
		$this->dateModified = $row['date_modified'];
		$this->createdBy = $row['created_by'];
		$this->updatedBy = $row['updated_by'];
		$this->status = $row['status'];
		$db->dispose($res);
		
		return true;
	}
	
	/**
	 * 
	 * @param $sortField
	 * @param $sortOrder
	 */
	public static function getAll($sortField, $sortOrder){
		$db = Database::getInstance();
		$sortSql = "";
		
		if ($sortField)
			$sortSql = " ORDER BY $sortField ".$sortOrder;
		
		$sql = "SELECT id,code,amount,`date`,provider,gloss,status FROM ".TBL_PURCHASE." $sortSql";
		$res = $db->query($sql);
		$result = array();
		$row = $db->getRow($res);
		
		while($row){
			$purchase = new Purchase();
			$purchase->id = $row['id'];
			$purchase->code = $row['code'];
			$purchase->amount = $row['amount'];
			$purchase->date = $row['date'];
			$purchase->provider = $row['provider'];
			$purchase->gloss = $row['gloss'];
			$purchase->status = $row['status'];
			$result[] = $purchase;
			$row = $db->getRow($res);
		}
		
		$db->dispose($res);
		
		return $result;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $sortField
	 * @param unknown_type $sortOrder
	 */
	public static function getAllOutstanding($sortField, $sortOrder){
		$db = Database::getInstance();
		$sortSql = "";
		
		if ($sortField)
			$sortSql = " ORDER BY $sortField ".$sortOrder;
		
		$sqlPaid = "SELECT pp.purchaseid, SUM(pp.amount) paid FROM ".TBL_PURCHASE_PAYMENT." pp GROUP BY pp.purchaseid";
		$sql = "SELECT p.id,p.code,p.amount,p.`date`,p.provider,p.gloss,p.status,status,IF(ptp.paid IS NULL,p.amount,p.amount-ptp.paid) outstanding ".
			"FROM ".TBL_PURCHASE." p LEFT JOIN ($sqlPaid) ptp ".
			"ON p.id=ptp.purchaseid WHERE p.amount>ptp.paid OR (ptp.paid IS NULL AND p.amount>0) $sortSql";

		$res = $db->query($sql);
		$result = array();
		$row = $db->getRow($res);
		
		while($row){
			$purchase = new Purchase();
			$purchase->id = $row['id'];
			$purchase->code = $row['code'];
			$purchase->amount = $row['amount'];
			$purchase->date = $row['date'];
			$purchase->provider = $row['provider'];
			$purchase->gloss = $row['gloss'];
			$purchase->status = $row['status'];
			$purchase->outstanding = $row['outstanding'];
			$result[] = $purchase;
			$row = $db->getRow($res);
		}
		
		$db->dispose($res);
		
		return $result;
	}
	
	/**
	 * 
	 * @param unknown_type $purchaseid
	 */
	public static function getAmountPaid($purchaseid){
		$db = Database::getInstance();
		$sql = "SELECT SUM(amount) amount_paid FROM ".TBL_PURCHASE_PAYMENT." WHERE purchaseid=$purchaseid";
		$res = $db->query($sql);
		 
		if ($db->rows($res) == 1){
			$row = $db->getRow($res);
			$db->dispose($res);
			
			return $row['amount_paid'];
		}
		
		return 0; 
	}
}
?>