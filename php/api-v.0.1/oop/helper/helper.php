<?php
require_once __DIR__.'../../shared/config.php';

$conn = (new Config())->getConnection();

    //Create Data Table
    function createTable($conn, $tableName, $columns){
        try{
            if(empty($tableName) || empty($columns)){
                throw new Exception("Table name and columns cannot be empty.");
            }

            $sql ="CREATE TABLE `$tableName` ($columns) ";
            // echo $sql;
            // exit;

            $stmt = $conn->prepare($sql);

            if($stmt->execute()){
                echo "$tableName create successfully";
            }else{
                echo "Failed to create $tableName: ". $stmt->errorInfo();
            }

        }catch(Exception $e){
            echo "Error: ". $e->getMessage();
        }
       
    }


    if(isset($_GET['createTable'])){
        
        $tableName = 'employees';
        $columns = "
        id int auto_increment primary key,
        emp_id varchar(250) unique not null,
        name varchar(50) not null,
        email varchar(50) unique not null,
        phone varchar(20),
        address text,
        designation varchar(50),
        branch varchar(20),
        salary int,
        join_date varchar(50),
        create_at DATETIME,
        updated_at DATETIME
        ";

        createTable($conn, $tableName, $columns );
    }





