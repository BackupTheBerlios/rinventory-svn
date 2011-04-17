<?php
class Log{
	private static $_instance;
	private $errors = array();
	
	/**
	 * Constructor
	 */
	private function __construct(){ }
   
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
	 * @param $error
	 */
	public function addError($error){
		$this->errors[] = $error;
	}
	
	/**
	 * 
	 */
	public function isError(){
		return count($this->errors) > 0;
	}
	
	/**
	 * 
	 */
	public function getErrors(){
		return $this->errors;
	}
}
?>