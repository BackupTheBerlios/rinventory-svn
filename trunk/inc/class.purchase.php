<?php
require_once 'inc/class.mysqli.php';

class PurchaseDetail {
	public $purchaseid;
	public $line;
	public $description;
	public $price;
	public $quantity;
}

class PurchasePayment {
	public $purchaseid;
}

class Purchase{
	public $id;
	public $code;
	public $date;
	public $prepayment;
	public $provider;
	public $gloss;
	public $userid;
	public $detail = array();
	
	/**
	 * 
	 */
	public function Add(){
		$db = Database::getInstance();
		$amount = 0;
		$res = false;
		
		foreach ($this->detail as $detail){
			$amount += ($detail->price * $detail->quantity);	
		}
		
		$sql = "INSERT INTO ".TBL_PURCHASE." (code,`date`,date_modified,provider,amount,prepayment,gloss,userid)".
			" VALUES ".
			"('$this->code','$this->date',NOW(),'$this->provider',$amount,$this->prepayment,'$this->gloss',$this->userid)";
		
		$res = $db->query($sql);
		
		if (!$res)
			return false;
		
		$purchaseid = $db->lastID();
		
		if ($this->prepayment > 0){
			$sql = "INSERT INTO ".TBL_PURCHASE_PAYMENT." (purchaseid,line,`date`,amount,userid)".
				" VALUES ".
				"($purchaseid,1,NOW(),$this->prepayment,$this->userid)";
			
			$res = $db->query($sql);
		}
		
		foreach($this->detail as $detail){
			$sql = "INSERT INTO ".TBL_PURCHASE_DETAIL." (purchaseid,line,description,quantity,price)".
				" VALUES ".
				"($purchaseid,$detail->line,'$detail->description',$detail->quantity,$detail->price)";
			
			$res = $db->query($sql);
		}
		
		$this->id = $purchaseid;
		
		return true;
	}
	
	/**
	 * 
	 * @param unknown_type $purchaseid
	 */
	public function read($purchaseid, $fillDetail){
		$db = Database::getInstance();
		
		$sql = "SELECT code,`date`,provider,gloss,amount,prepayment,date_modified,userid FROM ".TBL_PURCHASE." WHERE id=$purchaseid";
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
		$this->userid = $row['userid'];
		
		if(!$fillDetail)
			return true;
			
		$sql = "SELECT line,description,quantity,price FROM ".TBL_PURCHASE_DETAIL." WHERE purchaseid=$purchaseid";
		$res = $db->query($sql);
		$this->detail = array();
		$row = $db->getRow($res);
		 
		while($row){
			$detail = new PurchaseDetail();
			$detail->line = $row['line'];
			$detail->description = 	$row['description'];
			$detail->price = $row['price'];
			$detail->quantity = $row['quantity'];
			$this->detail[] = $detail;
			$row = $db->getRow($res,0);
		}
		
		$db->dispose($res);
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
		
		$sql = "SELECT id,code,amount,`date`,provider,gloss FROM ".TBL_PURCHASE." $sortSql";
		$res = $db->query($sql);
		$result = array();
		$row = $db->getRow($res);
		
		while($row){
			$result[] = $row;
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
		$sql = "SELECT p.id,p.code,p.amount,p.`date`,p.provider,p.gloss,IF(ptp.paid IS NULL,p.amount,p.amount-ptp.paid) outstanding ".
			"FROM ".TBL_PURCHASE." p LEFT JOIN ($sqlPaid) ptp ".
			"ON p.id=ptp.purchaseid WHERE p.amount>ptp.paid OR (ptp.paid IS NULL AND p.amount>0) $sortSql";

		$res = $db->query($sql);
		$result = array();
		$row = $db->getRow($res);
		
		while($row){
			$result[] = $row;
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