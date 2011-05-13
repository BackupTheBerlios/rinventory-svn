<?php
require_once 'inc/class.mysqli.php';
require_once 'inc/class.log.php';

class Item{
	public $id;
	public $name;
	public $type;
	public $material;
	public $priceUnit;
	public $pricePack;
	public $priceBox;
	public $stock;
	public $stockMin;
	public $trademark;
	public $image;
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $itemid
	 */
	public function read($itemid){
		$db = Database::getInstance();
		$log = Log::getInstance();
		$sql = "SELECT link_type_item type,".
			"v_descr name,material,".
			"price_unit,price_paq price_pack,price_box,".
			"stock_min,link_marca trademark,image ".
			"FROM ".TBL_ITEM." WHERE id=$itemid";
		$res = $db->query($sql);
		
		if (!$res){
			$log->addError("No se puedo obtener datos de Producto.");
			return false;
		}
		
		if ($db->rows($res) != 1){
			$log->addError("No se encontraron datos de Producto solicitado.");
			$db->dispose($res);
			return false;
		}
		
		$row = $db->getRow($res);
		$this->id = $itemid;
		$this->name = $row['name'];
		$this->type = $row['type'];
		$this->stockMin = $row['stock_min'];
		$this->trademark = $row['trademark'];
		$this->priceUnit = $row['price_unit'];
		$this->priceBox = $row['price_box'];
		$this->pricePack = $row['price_pack'];
		$this->material = $row['material'];
		
		return true;
	}
	
	public static function getAll($sortOrder, $sortField){
		$db = Database::getInstance();
		$sort = "";
		$array = array();
		
		if ($sortOrder && $sortField)
			$sort = "ORDER BY $sortField ".($sortOrder == "a" ? "ASC" : "DESC");
		
		$sql = "SELECT id,link_type_item group_name,v_descr name,material FROM ".TBL_ITEM." $sort";
		$res = $db->query($sql);
		$row = $db->getRow($res);
		
		while($row){
			$array[] = $row;
			$row = $db->getRow($res);	
		}
		
		$db->dispose($res);
		
		return $array;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $storeid
	 * @param unknown_type $sortField
	 * @param unknown_type $sortOrder
	 */
	public static function getAllFromStore($storeid, $sortField, $sortOrder){
		$db = Database::getInstance();
		$sortSql = ($sortField ? "ORDER BY $sortField $sortOrder" : "");
		$result = array();
		$sql = "SELECT l.itemid, sum(l.stock) stock ".
			"FROM ".TBL_LOT." l WHERE l.active=1 AND l.idalmacen=$storeid GROUP BY l.itemid";
		
		$sql = "SELECT i.id,i.v_descr name,i.link_type_item type,i.material,i.price_unit,i.price_paq price_pack,i.price_box,il.stock,i.stock_min,i.link_marca trademark,i.image ".
			"FROM ".TBL_ITEM." i LEFT JOIN ($sql) il ON i.id=il.itemid $sortSql";
				
		$res = $db->query($sql);

		if (!$res)
			return $result;
		
		$row = $db->getRow($res);
		
		while($row){
			$item = new Item();
			$item->id = $row['id'];
			$item->name = $row['name'];
			$item->type = $row['type'];
			$item->material = $row['material'];
			$item->priceUnit = $row['price_unit'];
			$item->pricePack = $row['price_pack'];
			$item->priceBox = $row['price_box'];
			$item->stockMin = $row['stock_min'];
			$item->stock = $row['stock'];
			$item->trademark = $row['trademark'];
			$item->image = $row['image']; 
			$result[] = $item;	
			$row = $db->getRow($res);
		}
		
		$db->dispose($res);
		
		return $result;
	}
	
	/**/
	
	public static function getFromLot($lotid){
		$db = Database::getInstance();
		$sql = "SELECT i.id,i.link_type_item type,i.v_descr name FROM ".TBL_ITEM." i INNER JOIN ".TBL_LOT." l ON i.id=l.itemid WHERE l.id=$lotid";
		$res = $db->query($sql);
		$item = new Item();
		
		if (!$res)
			return $item;
			
		if ($db->rows($res) == 1){
			$row = $db->getRow($res);
			$item->id = $row['id'];
			$item->name = $row['name'];
			$item->type = $row['type'];
		}
		
		$db->dispose($res);
		
		return $item; 
	}
}
?>