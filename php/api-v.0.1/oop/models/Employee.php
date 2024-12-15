<?php

require_once __DIR__ . '../../shared/config.php';

class Employee
{


    private $conn;
    public function __construct()
    {
        $this->conn = (new Config())->getConnection();
    }

    //Get All Data 
    public function getAllData()
    {
        $sql = "SELECT * FROM employees WHERE";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            $res = $result->fetch_all(MYSQLI_ASSOC);

            if ($res) {
                return $res;
            } else {
                return ["status" => "error", "message" => "Data not found"];
            }
        } else {
            return ["status" => "error", "message" => "Sql execute failed"];
        }
    }
    // New Employee Create
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


    // Find a data by id
    public function getDataById($id)
    {
        $sql = "SELECT * FROM employees WHERE emp_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $id);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            $res = $result->fetch_all(MYSQLI_ASSOC);

            if ($res) {
                return $res;
            } else {
                return ["status" => "error", "message" => "Data not found"];
            }
        } else {
            return ["status" => "error", "message" => "Sql execute failed"];
        }
    }

    // Update Employee

    public function update($data)
    {
        $sql = "UPDATE employees SET('name':?, 'email':?, 'phone':?, 'address':?, 'designation':?, 'branch':?, 'salary':?, 'join_date':?) WHERE emp_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssss", $data['name'], $data['email'], $data['phone'], $data['address'], $data['designation'], $data['branch'], $data['salary'], $data['join_date'], $data['emp_id']);
        if ($stmt) {

            $result = $stmt->execute();
            if ($result) {
                return ['status' => 'success', 'message' => $data['emp_id'] . 'Updated successfully'];
            } else {
                return ["status" => "error", "message" => "Execute failed"];
            }
        } else {
            return ["status" => "error", "message" => "Query prepare failed"];
        }

    }

    // Delete
    public function delete($id)
    {

        $sql = "DELETE employees WHERE emp_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $id);
        if ($stmt) {

            $result = $stmt->execute();
            if ($result) {
                return ['status' => 'success', 'message' => $id . 'Deleted'];
            } else {
                return ["status" => "error", "message" => "Execute failed"];
            }
        } else {
            return ["status" => "error", "message" => "Query prepare failed"];
        }

    }
}