<?php
require_once 'inc/class.mysql.php';

class Store{
	/**
	 * Returns an array with all active stores
	 */
	public static function getAllActive($sortField, $sortOrder=""){
		$db = Database::getInstance();
		$sortSql = "";
		$array = array();
		
		if ($sortField)
			$sortSql = "ORDER BY $sortField $sortOrder";
		
		$res = $db->query("SELECT id, name FROM ".TBL_DEPARTMENT." WHERE active=1 $sortSql");
		
		while($row = $db->getRow($res, 0)){
			$array[] = $row;
		}
		
		return $array;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $sourceLot
	 * @param unknown_type $targetStore
	 * @param unknown_type $quantity
	 * @param unknown_type $uid
	 */
	public static function transfer($sourceLot, $targetStore, $quantity, $uid){
		$db = Database::getInstance();
		$res = $db->query("SELECT * FROM ".TBL_LOT." WHERE id=$sourceLot AND active=1");
		
		if ($res){
			$lot = $db->getRow($res, 0);
			
			if ($lot['stock'] == $quantity){
				// full lot is sent to store
				$res = $db->query("UPDATE ".TBL_LOT." SET idalmacen=$targetStore,hw_updated=NOW(),by_modify=$uid WHERE id=$sourceLot");

				if (!$res)
					return false;
			}
			else if ($lot['stock'] > $quantity){
				$res = $db->query("INSERT INTO ".TBL_LOT." ".
					"(name,stock,active,idalmacen,costo,hw_added,by_added,by_modify,hw_updated,tran_mar,tran_ter,aduana,trans_bank,carga,otros,price_final,obs)".
					" VALUES ".
					"('{$lot['name']}',$quantity,1,$targetStore,{$lot['costo']},NOW(),$uid,$uid,NOW(),{$lot['tran_mar']},{$lot['tran_ter']},{$lot['aduana']},{$lot['trans_bank']},{$lot['carga']},{$lot['otros']},{$lot['price_final']},'');");
				
				if (!$res)
					return false;
				
				$res = $db->query("UPDATE ".TBL_LOT." SET stock=stock-$quantity,by_modify=$uid,hw_updated=NOW() WHERE id=$sourceLot");

				if (!$res)
					return false;
			}
			else
				return false;
		}
		else
			return false;
			
		return true;
	}
} 
?>
