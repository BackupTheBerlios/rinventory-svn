<?php
require_once 'inc/class.mysqli.php';
require_once 'inc/class.log.php';
require_once 'inc/class.session.php';

class Lot{
	public $id;
	public $boxes;
	public $units;
	public $active;
	public $stock;
	public $cost;
	public $itemid;
	public $storeid;
	public $userid;
	public $costTer;
	public $costMar;
	public $costAdu;
	public $costBank;
	public $costLoad;
	public $costOther;
	public $price;
	public $gloss;
	
	public static function getAllFromStore($storeid){
		$db = Database::getInstance();
		$result = array();
		$sql = "SELECT l.itemid, l.id lotid,sum(l.stock) stock ".
			"FROM ".TBL_LOT." l WHERE l.active=1 AND l.idalmacen=$storeid GROUP BY l.itemid, l.id HAVING stock>0";
		
		$sql = "SELECT i.id,i.v_descr name,i.link_type_item type,i.material,i.price_unit,i.price_paq price_pack,i.price_box,il.lotid,il.stock,ll.unidades units_box ".
			"FROM ".TBL_ITEM." i INNER JOIN ($sql) il ON i.id=il.itemid ".
			"INNER JOIN ".TBL_LOT." ll ON il.lotid=ll.id";
				
		$res = $db->query($sql);

		if (!$res)
			return $result;
		
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
	 */
	public function add(){
		$db = Database::getInstance();
		$log = Log::getInstance();
		$session = Session::getInstance();
		
		$sql = "INSERT INTO ".TBL_LOT." ".
			"(itemid,cajas,unidades,stock,".
			"active,idalmacen,costo,".
			"hw_added,hw_updated,by_added,by_modify,".
			"tran_mar,tran_ter,aduana,trans_bank,carga,otros,".
			"price_final,obs)".
			" VALUES ".
			"($this->itemid,$this->boxes,$this->units,$this->stock,".
			"$this->active,$this->storeid,$this->cost,".
			"NOW(),NOW(),$session->uniqueid,$session->uniqueid,".
			"$this->costMar,$this->costTer,$this->costAdu,$this->costBank,$this->costLoad,$this->costOther,".
			"$this->price,'$this->gloss')";

		$res = $db->query($sql);
		
		if (!$res){
			$log->addError("No se pudo agregar Lote.");
			return false;
		}
		
		$this->id = $db->lastID();
		
		return true;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $lotid
	 */
	public function read($lotid){
		$db = Database::getInstance();
		$log = Log::getInstance();
		$sql = "SELECT itemid,cajas,unidades,stock,active,idalmacen,costo,tran_mar,tran_ter,aduana,trans_bank,otros,price_final,obs FROM ".TBL_LOT." WHERE id=$lotid";
		$res = $db->query($sql);
		
		if (!$res){
			$log->addError("No se pudo recuperar informaci&oacute;n de Lote.");
			return false;
		}
		
		if ($db->rows($res) != 1){
			$log->addError("Lote solicitado no existe.");
			$db->dispose($res);
			return false;
		}
		
		$row = $db->getRow($res);
		$this->id = $lotid;
		$this->itemid = $row['itemid'];
		$this->boxes = $row['cajas'];
		$this->units = $row['unidades'];
		$this->active = $row['active'];
		$this->storeid = $row['idalmacen'];
		$this->cost = $row['costo'];
		$this->costMar = $row['tran_mar'];
		$this->costTer = $row['tran_ter'];
		$this->costAdu = $row['aduana'];
		$this->costBank = $row['trans_bank'];
		$this->price = $row['price_final'];
		$this->stock = $row['stock'];
		$this->gloss = $row['obs'];
		$db->dispose($res);
		
		return true;
	}
}
?>