<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once 'config.php';
require_once 'oop/controllers/Employees.php';

$method = $_SERVER['REQUEST_METHOD'];

// if (isset($_GET['agent'])) {
//     require_once 'functional/controllers/agentController.php';

//     if (array_key_exists('getall', $_GET)) {

//         getAllAgents($conn);

//     } else if (array_key_exists('getbyid', $_GET)) {

//         $agentId = $_GET['getbyid'];
//         getAgentById($conn, $agentId);

//     } else if (array_key_exists('create', $_GET)) {

//         $getData = json_decode(file_get_contents('php://input'), true);

//         createAgent($conn, $getData);

//     } else if (array_key_exists('delete', $_GET)) {
//         $agentId = $_GET['agentid'];
//         deleteAgent($conn, $agentId);


//     } else if (array_key_exists('updated', $_GET)) {

//         $agentId = $_GET['agentid'];

//         agentUpdate($conn, $agentId);


//     }

// } elseif (isset($_GET['deposit'])) {
//     require_once 'functional/controllers/depositController.php';
// }




//OOP Route


if (isset($_GET['emp'])) {
    $reqMethod = $_SERVER['REQUEST_METHOD'];

    if ($reqMethod == 'POST') {

        $input = json_decode(file_get_contents('php://input'), true);

        Employees::createNewEmp($input);
    } else if ($reqMethod == 'GET' && isset($_GET['id'])) {

        $empId = $_GET['id'];
        Employees::getEmpById($empId);
    }else if($reqMethod == "PUT"){

        $input = json_decode(file_get_contents('php://input'), true);
        Employees::updatedEmp($input);
    }else if($reqMethod == "DELETE"){
        $input = json_decode(file_get_contents("php://input"), true);
        Employees::deletEmp($input['emp_id']);
    }
}


?>