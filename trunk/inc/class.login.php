<?php
require_once 'inc/class.mysqli.php';

class Login
{
	private static $_instance;
	private $num_active_users;   //Number of active users viewing site
	private $num_active_guests;  //Number of active guests viewing site
	private $num_members;        //Number of signed-up users
	
	/**
	 * Constructor
	 */
	private function __construct(){
      /**
       * Only query database to find out number of members
       * when getNumMembers() is called for the first time,
       * until then, default value set.
       */
      $this->num_members = -1;
      
      if(TRACK_VISITORS){
         /* Calculate number of users at site */
         $this->calcNumActiveUsers();
      
         /* Calculate number of guests at site */
         $this->calcNumActiveGuests();
      }
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
    * confirmUserPass - Checks whether or not the given
    * username is in the database, if so it checks if the
    * given password is the same password in the database
    * for that user. If the user doesn't exist or if the
    * passwords don't match up, it returns an error code
    * (1 or 2). On success it returns 0.
    */
   function confirmUserPass($username, $password){
   	$db = Database::getInstance();
   	
      /* Add slashes if necessary (for query) */
      if(!get_magic_quotes_gpc())
      	$username = addslashes($username);
      
      /* Verify that user is in database */
      $q = "SELECT pwd FROM ".TBL_USER." WHERE username = '$username'";
      $result = $db->query($q);

      if(!$result || ($db->rows($result) < 1)){
         return 1; //Indicates username failure
      }

      /* Retrieve password from result, strip slashes */
      $dbarray = $db->getRow($result, 0);
      $dbarray['pwd'] = stripslashes($dbarray['pwd']);
      $password = stripslashes($password);

      /* Validate that password is correct */
      if($password == $dbarray['pwd']){
         return 0; //Success! Username and password confirmed
      }
      else{
         return 2; //Indicates password failure
      }
   }
   
   /**
    * confirmUserID - Checks whether or not the given
    * username is in the database, if so it checks if the
    * given userid is the same userid in the database
    * for that user. If the user doesn't exist or if the
    * userids don't match up, it returns an error code
    * (1 or 2). On success it returns 0.
    */
   function confirmUserID($username, $userid){
   	$db = Database::getInstance();
   	
      // Add slashes if necessary (for query)
      if(!get_magic_quotes_gpc())
      	$username = addslashes($username);

      // Verify that user is in database
      $q = "SELECT userid FROM ".TBL_USER." WHERE username = '$username'";
      $result = $db->query($q);
      
      if(!$result || ($db->rows($result) < 1))
         return 1; //Indicates username failure

      // Retrieve userid from result, strip slashes
      $dbarray = $db->getRow($result, 0);
      $dbarray['userid'] = stripslashes($dbarray['userid']);
      $userid = stripslashes($userid);

      // Validate that userid is correct
      if($userid == $dbarray['userid']){
         return 0; //Success! Username and userid confirmed
      }
      else{
         return 2; //Indicates userid invalid
      }
   }
   
   /**
    * usernameTaken - Returns true if the username has
    * been taken by another user, false otherwise.
    */
   function isUsernameTaken($username){
   	$db = Database::getInstance();
   	
		if(!get_magic_quotes_gpc())
			$username = addslashes($username);

      $q = "SELECT username FROM ".TBL_USER." WHERE username = '$username'";
      $result = $db->query($q);
      
      return $db->rows($result) > 0;
   }
   
   /**
    * usernameBanned - Returns true if the username has
    * been banned by the administrator.
    */
   function isUsernameBanned($username){
      $db = Database::getInstance();
      
   	if(!get_magic_quotes_gpc())
         $username = addslashes($username);
      
      $q = "SELECT username FROM ".TBL_BANNED_USER." WHERE username = '$username'";
      $result = $db->query($q);
      
      return $db->rows($result) > 0;
   }
   
   /**
    * addNewUser - Inserts the given (username, password, email)
    * info into the database. Appropriate user level is set.
    * Returns true on success, false otherwise.
    */
   function addNewUser($username, $password, $email){
   	$db = Database::getInstance();
   	
      $time = time();
      
      // If admin sign up, give admin user level
      if(strcasecmp($username, ADMIN_NAME) == 0)
         $ulevel = ADMIN_LEVEL;
      else
         $ulevel = USER_LEVEL;
      
      $q = "INSERT INTO ".TBL_USER." ".
      	"(username, pwd, level, email, timestamp)".
      	" VALUES ".
      	"('$username', '$password', $ulevel, '$email', $time)";
      
      return $db->query($q);
   }
   
   /**
    * updateUserField - Updates a field, specified by the field
    * parameter, in the user's row of the database.
    */
   function updateUserField($username, $field, $value){
   	$db = Database::getInstance();
      $q = "UPDATE ".TBL_USER." SET $field='$value' WHERE username='$username'";
      
      return $db->query($q);
   }
   
   /**
    * getUserInfo - Returns the result array from a mysql
    * query asking for all information stored regarding
    * the given username. If query fails, NULL is returned.
    */
   function getUserInfo($username){
   	$db = Database::getInstance();
      $q = "SELECT * FROM ".TBL_USER." WHERE username = '$username'";
      $result = $db->query($q);
      
      // Error occurred, return given name by default
      if(!$result || $db->rows($result) < 1)
         return NULL;
      
      return $db->getRow($result, 0);
   }
   
   /**
    * getNumMembers - Returns the number of signed-up users
    * of the website, banned members not included. The first
    * time the function is called on page load, the database
    * is queried, on subsequent calls, the stored result
    * is returned. This is to improve efficiency, effectively
    * not querying the database when no call is made.
    */
   function getNumMembers(){
      if($this->num_members < 0){
      	$db = Database::getInstance();
         $q = "SELECT COUNT(*) FROM ".TBL_USER;
         $result = $db->query($q);
         $count = $db->getRow($result);
         $this->num_members = $count[0];
      }
      
      return $this->num_members;
   }
   
   /**
    * calcNumActiveUsers - Finds out how many active users
    * are viewing site and sets class variable accordingly.
    */
   function calcNumActiveUsers(){
      $db = Database::getInstance();
      $q = "SELECT * FROM ".TBL_USER_ONLINE;
      $result = $db->query($q);
      $this->num_active_users = $db->rows($result);
   }
   
   /**
    * calcNumActiveGuests - Finds out how many active guests
    * are viewing site and sets class variable accordingly.
    */
   function calcNumActiveGuests(){
      $db = Database::getInstance();
      $q = "SELECT * FROM ".TBL_ACTIVE_GUESTS;
      $result = $db->query($q);
      $this->num_active_guests = $db->rows($result);
   }
   
   /**
    * addActiveUser - Updates username's last active timestamp
    * in the database, and also adds him to the table of
    * active users, or updates timestamp if already there.
    */
   function addActiveUser($username, $time){
      $db = Database::getInstance();
   	$q = "UPDATE ".TBL_USER." SET timestamp='$time' WHERE username='$username'";
      $db->query($q);
      
      if(!TRACK_VISITORS)
      	return;
      	
      $q = "REPLACE INTO ".TBL_USER_ONLINE." VALUES ('$username', '$time')";
      $db->query($q);
      $this->calcNumActiveUsers();
   }
   
   /* addActiveGuest - Adds guest to active guests table */
   function addActiveGuest($ip, $time){
      if(!TRACK_VISITORS) 
      	return;
      $q = "REPLACE INTO ".TBL_ACTIVE_GUESTS." VALUES ('$ip', '$time')";
      mysql_query($q, $this->connection);
      $this->calcNumActiveGuests();
   }
   
   /* These functions are self explanatory, no need for comments */
   
   /* removeActiveUser */
   function removeActiveUser($username){
      if(!TRACK_VISITORS) 
      	return;
		
      $db = Database::getInstance();
      $q = "DELETE FROM ".TBL_USER_ONLINE." WHERE username = '$username'";
      $db->query($q);
      $this->calcNumActiveUsers();
   }
   
   /* removeActiveGuest */
   function removeActiveGuest($ip){
      if(!TRACK_VISITORS) 
      	return;
      
      $db = Database::getInstance();
      $q = "DELETE FROM ".TBL_ACTIVE_GUEST." WHERE ip = '$ip'";
      $db->query($q);
      $this->calcNumActiveGuests();
   }
   
   /* removeInactiveUsers */
   function removeInactiveUsers(){
      if(!TRACK_VISITORS) 
      	return;
      	
      $db = Database::getInstance();
      $timeout = time()- USER_TIMEOUT*60;
      $q = "DELETE FROM ".TBL_USER_ONLINE." WHERE timestamp < $timeout";
      $db->query($q);
      $this->calcNumActiveUsers();
   }

   /* removeInactiveGuests */
   function removeInactiveGuests(){
      if(!TRACK_VISITORS)
      	return;
      	
      $db = Database::getInstance();
      $timeout = time()-GUEST_TIMEOUT*60;
      $q = "DELETE FROM ".TBL_USER_GUEST." WHERE timestamp < $timeout";
      $db->query($q);
      $this->calcNumActiveGuests();
   }
};

?>