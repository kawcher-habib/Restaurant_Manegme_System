<?php


Class Utilities{

    public $prefix;


    //Id Generator 
    public function makeId($prefix):string {
            $randomNum = abs(rand(10, 1000));
            $Id = $prefix . $randomNum;
            return $Id;

    }
}