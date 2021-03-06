<?php
require_once 'inc/init.php';

/**
 * Manage database connections and queries.
 */ 
class Database{ 
   private $host; 
   private $user; 
   private $password; 
   private $db; 
   private $link; 
   private $stmt;  
 
   private static $_instance; 

   /**
    * Private constructor to avoid multiple instances (singleton)
    */
   private function __construct(){ 
      $this->setConnection(); 
      $this->connect(); 
   } 
 
   /**
    * Setup connection parameters
    */
   private function setConnection(){ 
      $this->host = DB_HOST; 
      $this->db = DB_NAME; 
      $this->user = DB_USER;
      $this->password = DB_PASS; 
   } 
 
   /**
    * Avoid cloning (singleton)
    */ 
	private function __clone(){ } 
 
   /**
    * Returns unique instance
    */ 
	public static function getInstance(){ 
		if (!(self::$_instance instanceof self)) 
			self::$_instance=new self();
			
		return self::$_instance; 
	} 
 
	/**
	 * 
	 */ 
	private function connect(){ 
		$this->link = mysqli_connect($this->host, $this->user, $this->password, $this->db);
		mysqli_set_charset($this->link, "utf8");
	}

	/**
	 * 
	 */
	public function startTransaction(){
		mysqli_autocommit($this->link, false);
	}
 
	/**
	 * 
	 * @param unknown_type $stmt
	 */
	public function commit(){
		$res = mysqli_commit($this->link);
		
		mysqli_autocommit($this->link, true);
		
		return $res;
	}
	
	/**
	 * 
	 */
	public function rollback(){
		mysqli_rollback($this->link);
		mysqli_autocommit($this->link, true);
	}
	
   /**
    * Execute query
    * @param string $sql
    */ 
   public function query($sql){ 
      $this->stmt = mysqli_query($this->link, $sql); 
      
      return $this->stmt; 
   }
   
 
   /**
    * Returns a row of query
    * @param $stmt
    * @param $row
    */
   public function getRow($stmt, $row=0){
      return $stmt->fetch_assoc();; 
   } 
 
   /**
    * 
    * @param unknown_type $stmt
    */
	public function rows($stmt){
		return $stmt->num_rows;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $stmt
	 */
	public function dispose($stmt){
		mysqli_free_result($stmt);
	}
   
	/**
	 * Returns the last insert ID
	 */ 
	public function lastID(){ 
		return mysqli_insert_id($this->link); 
	}
   
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $str
	 */
	public function escape($str){
		return mysqli_real_escape_string($this->link, $str);
	}
   
	/**
	 * 
	 * Enter description here ...
	 */
	public function close(){
		mysqli_close($this->link);
	}
}
?>