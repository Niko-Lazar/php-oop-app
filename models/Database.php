<?php

namespace Models;

class Database {

    public static $mysqli = null;

    public static function startConn($dbhost = "localhost", $username = 'admin', $password = '123', $dbname = 'php-oop-app'){

        try{
	
            self::$mysqli = new \mysqli($dbhost, $username, $password, $dbname);
		
            if( mysqli_connect_errno() ){
                throw new \Exception("Could not connect to database.");   
            }
		
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());   
        }
    }

    public static function closeConn() {
        self::$mysqli->close();
    }
}

?>