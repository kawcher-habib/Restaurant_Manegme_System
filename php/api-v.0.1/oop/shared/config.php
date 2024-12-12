<?php

class Config
{

    public function getConnection()
    {

        $severName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "rest_mgt";


        $conn = new mysqli($severName, $userName, $password, $dbName);

        if ($conn->connect_error) {
            die("Data Base Connection Failed: " . $conn->connect_error);
        }
        return $conn;
    }
}


?>