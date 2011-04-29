<?php
require_once 'inc/class.mysqli.php';

class Item{
	public $id;
	public $name;
	public $type;
	
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