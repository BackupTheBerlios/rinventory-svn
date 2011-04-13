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
   private $array; 
 
   static $_instance; 

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
   	$this->link = mysql_connect($this->host, $this->user, $this->password); 
		mysql_select_db($this->db, $this->link); 
		@mysql_query("SET NAMES 'utf8'"); 
	} 
 
   /**
    * Execute query
    * @param string $sql
    */ 
   public function query($sql){ 
      $this->stmt=mysql_query($sql, $this->link); 
      
      return $this->stmt; 
   } 
 
   /**
    * Returns a row of query
    * @param $stmt
    * @param $row
    */
   public function getRow($stmt, $row){
   	if ($row == -1) 
   		$this->array=mysql_fetch_assoc($stmt);
      else if ($row==0)
         $this->array=mysql_fetch_array($stmt); 
      else{ 
         mysql_data_seek($stmt, $row); 
         $this->array = mysql_fetch_array($stmt); 
      } 
      
      return $this->array; 
   } 
 
   /**
    * 
    * @param unknown_type $stmt
    */
	public function rows($stmt){
		return mysql_num_rows($stmt);
	}
   
   /**
    * Returns the last insert ID
    */ 
   public function lastID(){ 
		return mysql_insert_id($this->link); 
   }
   
   /**
    * Escapes unsafe strings
    * 
    * @param unknown_type $str
    */
   public function escape($str){
   	return mysql_real_escape_string($str);
   }
}
?>