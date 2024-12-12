<?php


Class Utilities{

    //Id Generator 
    public function makeId($prefix):string {

            $timeStamp = substr(time(), -5);
            $randomNum = random_int(10, 1000);
            
            return $prefix .$timeStamp.$randomNum;

    }
}