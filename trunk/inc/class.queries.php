<?php
require_once 'inc/class.mysqli.php';

class Queries{

	/**
	 * Returns stock of items per store
	 */
	public static function getStock($storeid){
		$db = Database::getInstance();
		$array = array();
		$sql = "SELECT l.itemid, SUM(l.stock) stock FROM ".TBL_LOT." l WHERE l.active=1 AND l.idalmacen=$storeid GROUP BY l.itemid";
		$sql = "SELECT i.id, i.v_descr name, i.link_type_item type, ls.stock, i.stock_min FROM ".TBL_ITEM." i INNER JOIN ($sql) ls ON i.id=ls.itemid";
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
}
?>