<?php

namespace app\Framework;
use PDO;
class DB{
    public static function getConnection(){
        $host="127.0.0.1";
        $db="market_hub";
        $pwd="Habeascorpus19#";
        $port="3307";
        $user="root";
        $dsn="mysql:host=$host;dbname=$db;port=$port";
        
        return $pdo=new PDO($dsn,$user,$pwd);
    }
   

}

