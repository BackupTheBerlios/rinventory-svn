<?php
require_once 'inc/class.mysql.php';

class Item{
	public static function getAll($sortOrder, $sortField){
		$db = Database::getInstance();
		$sort = "";
		
		if ($sortOrder && $sortField)
			$sort = "ORDER BY $sortField ".($sortOrder == "a" ? "ASC" : "DESC");
		
		return $db->query("SELECT id,link_type_item group_name,v_descr name,material FROM ".TBL_ITEM." $sort");
	}
	
	public static function getAllFromStore($storeId){
		$db = Database::getInstance();
		$ids = "";
		
		$db->query("SELECT i.id ".
			"FROM ".TBL_LOT." l INNER JOIN ".TBL_ITEM." i ON l.name=i.id ".
			"WHERE l.active=1 AND l.stock>0 ".
			"GROUP BY i.id");
		
		while($row = $db->getRow($db, 0)){
			$ids .= $row['id'].",";
		}
		
		if(strlen($ids)>0)
			$ids = substr($ids, 0, strlen($ids)-1);
			
		var_dump($ids);
	}
}
?>