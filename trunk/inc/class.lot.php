<?php
require_once 'inc/class.mysqli.php';

class Lot{
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
}
?>