<?php
// echo __DIR__;
require_once __DIR__ . "../../models/agentModel.php";


define('TABLE_AGENT', 'agent');

/**
 * Get All Agent 
 **/


function getAllAgents($conn)
{

    // Check user validation
    $agentData = getAllData($conn, TABLE_AGENT);
    if (isset($agentData['error'])) {
        http_response_code(500);
        echo json_encode($agentData);
        exit;

    }
    echo json_encode($agentData);
}


/**
 * Get Agent Data By ID
 */

function getAgentById($conn, $agentId)
{

    $getAgentData = getDataById($conn, TABLE_AGENT, $agentId);

    if (isset($getAgentData['error'])) {
        http_response_code(500);
        echo json_encode($getAgentData);
        exit;

    }

    echo json_encode($getAgentData);

}

// Create New Agent

function createAgent($conn, $data)
{

    $createNewAgent = createNew($conn, TABLE_AGENT, $data);

    if (isset($createNewAgent['error'])) {
        http_response_code(500);
        echo json_encode($createNewAgent);
    } else {
        echo json_encode($createNewAgent);
    }

}

//Update Agent

function agentUpdate($conn, $agentId){
    $data = json_decode(file_get_contents('php://input'), true);

    $updatedAgent = updateData($conn, TABLE_AGENT, $data, $agentId);
}


// Delete Agent
function deleteAgent($conn, $agentId)
{

    $agentDelete = deleteData($conn, TABLE_AGENT, $agentId);


}



?>