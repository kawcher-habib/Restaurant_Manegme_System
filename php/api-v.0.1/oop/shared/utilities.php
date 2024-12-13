<?php

require_once __DIR__ ."../config.php";

Class Utilities{

    private $conn;

    public function __construct(){
        $this->conn = (new config())->getConnection();
    }

    //Id Generator 
    public function makeId($prefix):string {

            $timeStamp = substr(time(), -5);
            $randomNum = random_int(10, 1000);
            
            return $prefix .$timeStamp.$randomNum;

    }


    // Validation Checker 

    public function isItHere($tableName, $columen){
        $data =$this->conn->query("SELECT * FROM $tableName WHERE $columen")->fetch_all();
        if(!empty($data)) return true;
        else return false;

    }
}