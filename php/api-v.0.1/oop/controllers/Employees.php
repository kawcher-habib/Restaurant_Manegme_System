<?php

require_once __DIR__ . '../../models/Employee.php';
require_once __DIR__ . '../../shared/utilities.php';
require_once __DIR__ . '../../shared/config.php';
require_once __DIR__ . '../Users.php';

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

    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    public static function createNewEmp($input)
    {
        // echo json_encode($input);

        // Validation and Id maker and so on
        $utilities = new Utilities();

        $name = $input['name'];
        $email = $input['email'];
        $phoneNum = $input['phone'];
        $address = $input['address'];

        // $isEmpty = array([
        //     "name"=> "Name is required",
        //     "email" => "Email is required",
        //     "phone" => "Phone is required",
        //     "address" => "Address is required"
        // ]);

        if (empty(trim($name)) || empty(trim($email)) || empty(trim($phoneNum)) || empty(trim($address))) {
            echo json_encode(["status" => "error", "message" => "name , email, phone, address is required"]);
            exit;
        }


        //  // Employee Id
        $empId = $utilities->makeId('EMP');
        $input['emp_id'] = $empId;
        //   print_r($input);

        $newEmp = (new Employee())->create($input);

        echo json_encode($newEmp);

    }

}