<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];

if (isset($_GET['agent'])) {
    require_once 'functional/controllers/agentController.php';

    if (array_key_exists('getall', $_GET)) {

        getAllAgents($conn);

    } else if (array_key_exists('getbyid', $_GET)) {

        $agentId = $_GET['getbyid'];
        getAgentById($conn, $agentId);

    } else if (array_key_exists('create', $_GET)) {

        $getData = json_decode(file_get_contents('php://input'), true);

        createAgent($conn, $getData);

    } else if (array_key_exists('delete', $_GET)) {
        $agentId = $_GET['agentid'];
        deleteAgent($conn, $agentId);


    } else if (array_key_exists('updated', $_GET)) {

        $agentId = $_GET['agentid'];

        agentUpdate($conn, $agentId);


    }

} elseif (isset($_GET['deposit'])) {
    require_once 'functional/controllers/depositController.php';
}


?>