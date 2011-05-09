<?php
require_once 'inc/class.mysqli.php';
require_once 'inc/class.session.php';
require_once 'inc/class.log.php';
require_once 'inc/class.item.php';

class SellPayment{
	public $sellid;
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
		$sql = "SELECT MAX(line)+1 newline FROM ".TBL_SELL_PAYMENT." WHERE sellid=$this->sellid";
		$res = $db->query($sql);
		$row = $db->getRow($res);
		$newline = $row['newline'];
		
		if (!$newline)
			$newline = 1;
			
		$sql = "INSERT INTO ".TBL_SELL_PAYMENT." ".
			"(sellid,line,amount,`date`,created_by,updated_by)".
			" VALUES ".
			"($this->sellid,$newline,$this->amount,NOW(),'$user','$user')";

		$db->dispose($res);
		$res = $db->query($sql);
		
		if (!$res){
			$db->rollback();
			$log->addError("No se pudo agregar pago.");
			return false;
		}
		
		// Check amount
		$sql = "SELECT p.amount, ".
			"(SELECT SUM(pp.amount) FROM ".TBL_SELL_PAYMENT." pp WHERE pp.sellid=$this->sellid) paid ".
			"FROM ".TBL_SELL." p WHERE p.id=$this->sellid";
		
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
			$log->addError("No se pudo agregar pago, monto introducido excede total de la venta.");
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
	public static function getAll($sellid){
		$db = Database::getInstance();
		$array = array();
		$sql = "SELECT line,date,amount,created_by,updated_by FROM ".TBL_SELL_PAYMENT." WHERE sellid=$sellid";
		$res = $db->query($sql);
		
		if (!$res)
			return $array;
		
		$row = $db->getRow($res);
			
		while($row){
			$ppayment = new SellPayment();
			$ppayment->sellid = $sellid;
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

class SellDetail{
	public $sellid;
	public $line;
	public $description;
	public $price;
	public $quantity;
	public $unit;
	public $lotid;
	
	public static function getAll($sellid){
		$db = Database::getInstance();
		$array = array();
		$sql = "SELECT line,description,quantity,price,unit_type unit FROM ".TBL_SELL_DETAIL." WHERE sellid=$sellid";
		$res = $db->query($sql);
		
		if (!$res)
			return $array;
			
		$row = $db->getRow($res);
		 
		while($row){
			$detail = new SellDetail();
			$detail->line = $row['line'];
			$detail->description = 	$row['description'];
			$detail->price = $row['price'];
			$detail->unit = $row['unit'];
			$detail->quantity = $row['quantity'];
			$array[] = $detail;
			$row = $db->getRow($res);
		}
		
		$db->dispose($res);
		
		return $array;
	}
}

class Sell{
	public $id;
	public $date;
	public $prepayment;
	public $paymentType;
	public $customer;
	public $gloss;
	public $dateCreated;
	public $dateModified;
	public $createdBy;
	public $updatedBy;
	public $status;
	public $amount;
	public $nit;
	public $storeid;
	public $outstanding;
	public $detail = array();
	
	public function add(){
		$db = Database::getInstance();
		$session = Session::getInstance();
		$log = Log::getInstance();
		$amount = 0;
		$res = false;
		$user = $db->escape($session->userinfo['firstname']." ".$session->userinfo['lastname']);
		
		foreach ($this->detail as $detail){
			$amount += ($detail->price * $detail->quantity);	
		}
		
		$sql = "INSERT INTO ".TBL_SELL." ".
			"(`date`,date_created,date_modified,".
			"customer,amount,prepayment,payment_type,".
			"gloss,status,nit,".
			"storeid,created_by,updated_by)".
			" VALUES ".
			"('$this->date',NOW(),NOW(),".
			"'".$db->escape($this->customer)."',$amount,$this->prepayment,$this->paymentType,".
			"'".$db->escape($this->gloss)."',".PURCHASE_STATUS_PENDING.",'".$db->escape($this->nit)."',".
			"$this->storeid,'$user','$user')";
		
		$db->startTransaction();
		$res = $db->query($sql);
		
		if (!$res){
			$db->rollback();
			$log->addError("No se puedo agregar Venta, verifique los datos ingresados.");
			return false;
		}
		
		$sellid = $db->lastID();
		
		if ($this->paymentType == PAYMENT_TYPE_CASH)
			$this->prepayment = $amount;
			
		if ($this->prepayment > 0){
			$sql = "INSERT INTO ".TBL_SELL_PAYMENT." (sellid,line,`date`,amount,created_by,updated_by)".
				" VALUES ".
				"($sellid,1,NOW(),$this->prepayment,'$user','$user')";
			
			$res = $db->query($sql);
			
			if (!$res){
				$db->rollback();
				$log->addError("Problemas para agregar el anticipo de Venta especificado.");
				return false;
			}
		}
		
		foreach($this->detail as $detail){
			//if (!$detail->quantity || !$detail->price)
			//	continue;

			// Check available stock 
			$sql = "SELECT stock,unidades units_per_box FROM ".TBL_LOT." WHERE id=$detail->lotid";
			$res = $db->query($sql);
			
			if (!$res){
				$db->rollback();
				$log->addError("No se puede verificar stock disponible de lote $detail->lotid.");
				return false;
			}
			
			if ($db->rows($res) != 1){
				$db->dispose($res);
				$db->rollback();
				$log->addError("Lote $detail->lotid no est&aacute; disponible.");
				return false;
			}
			
			$row = $db->getRow($res);
			$quantity = $detail->quantity;
			$units = 1;
			
			if ($detail->unit == UNIT_TYPE_BOX){
				$units = $row['units_per_box'];
				$quantity = $detail->quantity*$units;
			}
			else if ($detail->unit == UNIT_TYPE_PACKAGE){
				// TODO
			}
				
			if ($row['stock'] < $quantity){
				$db->dispose($res);
				$db->rollback();
				$log->addError("Stock insuficiente en lote $detail->lotid.");
				return false;
			}

			// Update stock for lot
			$sql = "UPDATE ".TBL_LOT." SET stock=stock-$quantity WHERE id=$detail->lotid";
			$res = $db->query($sql);
			
			if (!$res){
				$db->rollback();
				$log->addError("No se puede no se puede actualizar stock de lote $detail->lotid.");
				return false;
			}
			
			// Insert detail
			$item = Item::getFromLot($detail->lotid);
			$detail->description = $item->name;	
			$sql = "INSERT INTO ".TBL_SELL_DETAIL." (sellid,line,description,quantity,price,unit_type,units)".
				" VALUES ".
				"($sellid,$detail->line,'$detail->description',$detail->quantity,$detail->price,'$detail->unit',$units)";
			
			$res = $db->query($sql);
			
			if (!$res){
				$db->rollback();
				$log->addError("Problemas para agregar el detalle de Venta especificado.");
				return false;
			}
		}
		
		if(!$db->commit())
			return false;
			
		$this->id = $sellid;
		
		return true;	
	}
	
	/**
	 * 
	 */
	public function update(){
		$db = Database::getInstance();
		$session = Session::getInstance();
		$updated_by = $db->escape($session->userinfo['firstname']." ".$session->userinfo['lastname']);
		$sql = "UPDATE ".TBL_SELL." SET ".
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
	public function read($sellid){
		$db = Database::getInstance();
		
		$sql = "SELECT `date`,customer,gloss,amount,prepayment,date_modified,date_created,created_by,updated_by,status,nit,payment_type FROM ".TBL_SELL." WHERE id=$sellid";

		$res = $db->query($sql);
		
		if ($db->rows($res) != 1)
			return false;
			
		$row = $db->getRow($res, 0);
		$this->id = $sellid;
		$this->date = $row['date'];
		$this->gloss = $row['gloss'];
		$this->prepayment = $row['prepayment'];
		$this->paymentType = $row['payment_type'];
		$this->customer = $row['customer'];
		$this->dateCreated = $row['date_created'];
		$this->dateModified = $row['date_modified'];
		$this->createdBy = $row['created_by'];
		$this->updatedBy = $row['updated_by'];
		$this->status = $row['status'];
		$this->nit = $row['nit'];
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
		
		$sql = "SELECT id,amount,`date`,customer,gloss,status FROM ".TBL_SELL." $sortSql";
		$res = $db->query($sql);
		$result = array();
		$row = $db->getRow($res);
		
		while($row){
			$sell = new Sell();
			$sell->id = $row['id'];
			$sell->amount = $row['amount'];
			$sell->date = $row['date'];
			$sell->provider = $row['customer'];
			$sell->gloss = $row['gloss'];
			$sell->status = $row['status'];
			$result[] = $sell;
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
		
		$sqlPaid = "SELECT pp.sellid, SUM(pp.amount) paid FROM ".TBL_SELL_PAYMENT." pp GROUP BY pp.sellid";
		$sql = "SELECT p.id,p.amount,p.`date`,p.customer,p.gloss,p.status,status,IF(ptp.paid IS NULL,p.amount,p.amount-ptp.paid) outstanding ".
			"FROM ".TBL_SELL." p LEFT JOIN ($sqlPaid) ptp ".
			"ON p.id=ptp.sellid WHERE p.amount>ptp.paid OR (ptp.paid IS NULL AND p.amount>0) $sortSql";

		$res = $db->query($sql);
		$result = array();
		$row = $db->getRow($res);
		
		while($row){
			$sell = new Sell();
			$sell->id = $row['id'];
			$sell->amount = $row['amount'];
			$sell->date = $row['date'];
			$sell->customer = $row['customer'];
			$sell->gloss = $row['gloss'];
			$sell->status = $row['status'];
			$sell->outstanding = $row['outstanding'];
			$result[] = $sell;
			$row = $db->getRow($res);
		}
		
		$db->dispose($res);
		
		return $result;
	}
	
	/**
	 * 
	 * @param unknown_type $purchaseid
	 */
	public static function getAmountPaid($sellid){
		$db = Database::getInstance();
		$sql = "SELECT SUM(amount) amount_paid FROM ".TBL_SELL_PAYMENT." WHERE sellid=$sellid";
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