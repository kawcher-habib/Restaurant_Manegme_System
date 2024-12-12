<?php

require_once __DIR__.'../../shared/config.php';

class Employee
{


    private $conn;
    public function __construct()
    {
        $this->conn = (new Config())->getConnection();
    }

    public function create($data)
    {

        try {

            $sql = $this->conn->prepare("INSERT INTO employees(emp_id, name, email, phone, address, designation, branch, salary, join_date)VALUES(?,?,?,?,?,?,?,?,?)");

            $sql->execute([
                $data['emp_id'],
                $data['name'],
                $data['email'],
                $data['phone'],
                $data['address'],
                $data['designation'],
                $data['branch'],
                $data['salary'],
                $data['join_date'],
            ]);

            return ["status" => "success", "message" => "Employee create successfully"];

        } catch (Exception $e) {
            return ["status" => "error", "message" => $e->getMessage()];
        }

    }

}