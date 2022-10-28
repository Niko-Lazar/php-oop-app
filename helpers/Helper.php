<?php

namespace Helpers;

class Helper
{
    public static function firstVisit() : string {
        if(!isset($_COOKIE['token']))
        {
            $token = uniqid();
            $expire=time()+2592000;
            setcookie('token', $token, $expire);
    
            $stmt = \Models\Database::$mysqli->prepare("INSERT INTO users (token) VALUES (?)");
            $stmt->bind_param("s", $token);
            $stmt->execute();
            
            return $token;
        }
        
       return $_COOKIE['token'];
    }

    public static function arrToObj(array $arr) : object {
        return json_decode(json_encode($arr), FALSE);
    }

    public static function objectsArray(array $arr) : array {
        $objectsArray = [];

        foreach($arr as $element) {
            $objectsArray[] = self::arrToObj($element);
        }
        
        return $objectsArray;
    }
}