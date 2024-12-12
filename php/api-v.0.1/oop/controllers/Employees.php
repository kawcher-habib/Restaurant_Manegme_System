<?php

require_once '../models/Users.php';
require_once '../shared/utilities.php';
require_once 'Users.php';

class Employees extends Users
{
    public $designation;
    private $salary;
    public $branch;

    public function __construct($name, $email, $phone, $address, $joinDate, $designation, $branch)
    {
        parent::__construct($name, $email, $phone, $address, $joinDate);
        $this->designation = $designation;
        $this->branch = $branch;

    }

    public function setSalary($salary){
        $this->salary = $salary;
    }

    public function createNewEmp($input){

        //Validation Check

        $email = $input['email']; $phoneNum = $input['phone'];

         // Employee Id
         $empId = new Utilities()->makeId('emp');

        $newEmp = new Employee();
        
        
       



        
    }

}