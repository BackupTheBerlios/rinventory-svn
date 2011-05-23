<?php
require_once 'inc/class.mysqli.php';
require_once 'inc/class.log.php';

class Queries{

	/**
	 * Returns stock of items per store
	 */
	public static function getStock($storeid, $sortField = '', $sortOrder = '', $limit = 10){
		$db = Database::getInstance();
		$array = array();
		$sortSql = $sortField ? "ORDER BY $sortField $sortOrder" : "";
		$sql = "SELECT l.itemid, SUM(l.stock) stock FROM ".TBL_LOT." l WHERE l.active=1 AND l.idalmacen=$storeid GROUP BY l.itemid";
		$sql = "SELECT i.id, i.v_descr name, i.link_type_item type, ls.stock, i.stock_min FROM ".TBL_ITEM." i INNER JOIN ($sql) ls ON i.id=ls.itemid $sortSql LIMIT $limit";
		$res = $db->query($sql);
		
		if (!$res)
			return $array;
		
		$row = $db->getRow($res);
		
		while($row){
			$array[] = $row;
			$row = $db->getRow($res);
		}
		
		return $array;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $itemid
	 * @param unknown_type $storeid
	 */
	public static function getLotsFromItem($itemid, $storeid){
		$db = Database::getInstance();
		$result = array();
		$sql = "SELECT l.id,".
			"s.name store,".
			"l.stock,".
			"l.active,".
			"l.price_final price ".
			"FROM ".TBL_LOT." l INNER JOIN ".TBL_DEPARTMENT." s ON s.id=l.idalmacen ".
			"WHERE l.itemid=$itemid AND l.stock>0 ".($storeid ? "AND s.id=$storeid" : "");
				
		$res = $db->query($sql);

		if (!$res){
			$log = Log::getInstance();
			$log->addError(ERROR_BD_QUERY." No se pudo obtener datos de Lotes.");
			return $result;
		}
		
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