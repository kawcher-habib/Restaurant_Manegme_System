<?php

require_once __DIR__ .'../../models/Employee.php';
require_once __DIR__.'../../shared/utilities.php';
require_once __DIR__. '../Users.php';

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

    public static function createNewEmp($input){
        // echo json_encode($input);
       

        // //Validation Check

         $email = $input['email']; $phoneNum = $input['phone'];

            
        //  // Employee Id
          $empId = (new Utilities())->makeId('EMP');
          $input['emp_id'] = $empId;
        //   print_r($input);

        $newEmp = (new Employee())->create($input);
        
        echo json_encode($newEmp);
        
    }

}