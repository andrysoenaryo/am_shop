<?php
    /*function db_connect() {

        // Define connection as a static variable, to avoid connecting more than once 
        static $connection;

        // Try and connect to the database, if a connection has not been established yet
        if(!isset($connection)) {
             // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('../config.ini'); 
            $connection = mysqli_connect('localhost',$config['username'],$config['password'],$config['dbname']);
        }

        // If connection was not successful, handle the error
        if($connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return mysqli_connect_error(); 
        }
		else
		{
			//echo "okok";
		}
        return $connection;
    }*/
	
//ini_set("display_errors", 'off');
//ini_set("error_reporting",E_ALL);   

/*class Connect {
    function Connect()   {    
        $user = "root";
        $pass = "";
        $server = "localhost";
        $dbase = "menu_template";

	   $conn = mysql_connect($server,$user,$pass);
	   if(!$conn)
        {
            $this->error("Connection attempt failed");
        }
        if(!mysql_select_db($dbase,$conn))
        {
            $this->error("Dbase Select failed");
        }
		else
		{
			echo "okok";
			
		}
        $this->CONN = $conn;
        return true;
    }
    function close()   {   
        $conn = $this->CONN ;
        $close = mysql_close($conn);
        if(!$close)
        {
            $this->error("Connection close failed");
        }
        return true;
    }       
	function sql_query($sql="")   
	{    
        if(empty($sql))
        {
            return false;
        }
        if(empty($this->CONN))
        {
            return false;
        }
        $conn = $this->CONN;
        $results = mysql_query($sql,$conn) or die("Query Failed..<hr>" . mysql_error());
        if(!$results)
        {   
            $message = "Bad Query !";
            $this->error($message);
            return false;
        }
        if(!(eregi("^select",$sql) || eregi("^show",$sql)))
        {
            return true;
        }
        else
        {
            $count = 0;
            $data = array();
            while($row = mysql_fetch_object($results))
            {
                $data[$count] = $row;
                $count++;
            }
            mysql_free_result($results);
            return $data;
         }
    }      
} */


class db {
	private $conn;
	private $host;
	private $user;
	private $password;
	private $baseName;
	private $port;
	private $Debug;
	
	function __construct($params=array()) {
		$this->conn = false;
		$this->host = 'localhost'; //hostname
		$this->user = 'root'; //username
		$this->password = ''; //password
		$this->baseName = 'menu_template'; //name of your database
		$this->port = '3306';
		$this->debug = true;
		$this->connect();
	}

	function __destruct() {
		$this->disconnect();
	}
	
	function connect() {
		if (!$this->conn) {
			$this->conn = mysql_connect($this->host, $this->user, $this->password);	
			mysql_select_db($this->baseName, $this->conn); 
			mysql_set_charset('utf8',$this->conn);
			
			if (!$this->conn) {
				$this->status_fatal = true;
				echo 'Connection BDD failed';
				die();
			} 
			else {
				$this->status_fatal = false;
				//echo "Connection Sucess coy";
			}
		}

		return $this->conn;
	}

	function disconnect() {
		if ($this->conn) {
			@pg_close($this->conn);
		}
	}
	
	function getOne($query) { // getOne function: when you need to select only 1 line in the database
		$cnx = $this->conn;
		if (!$cnx || $this->status_fatal) {
			echo 'GetOne -> Connection BDD failed';
			die();
		}

		$cur = @mysql_query($query, $cnx);

		if ($cur == FALSE) {		
			$errorMessage = @pg_last_error($cnx);
			$this->handleError($query, $errorMessage);
		} 
		else {
			$this->Error=FALSE;
			$this->BadQuery="";
			$tmp = mysql_fetch_array($cur, MYSQL_ASSOC);
			
			$return = $tmp;
		}

		@mysql_free_result($cur);
		return $return;
	}
	
	function getAll($query) { // getAll function: when you need to select more than 1 line in the database
		$cnx = $this->conn;
		if (!$cnx || $this->status_fatal) {
			echo 'GetAll -> Connection BDD failed';
			die();
		}
		
		mysql_query("SET NAMES 'utf8'");
		$cur = mysql_query($query);
		$return = array();
		
		while($data = mysql_fetch_assoc($cur)) { 
			array_push($return, $data);
		} 

		return $return;
	}
	
	function execute($query,$use_slave=false) { // execute function: to use INSERT or UPDATE
		$cnx = $this->conn;
		if (!$cnx||$this->status_fatal) {
			return null;
		}

		$cur = @mysql_query($query, $cnx);

		if ($cur == FALSE) {
			$ErrorMessage = @mysql_last_error($cnx);
			$this->handleError($query, $ErrorMessage);
		}
		else {
			$this->Error=FALSE;
			$this->BadQuery="";
			$this->NumRows = mysql_affected_rows();
			return;
		}
		@mysql_free_result($cur);
	}
	
	function handleError($query, $str_erreur) {
		$this->Error = TRUE;
		$this->BadQuery = $query;
		if ($this->Debug) {
			echo "Query : ".$query."<br>";
			echo "Error : ".$str_erreur."<br>";
		}
	}
}

?>