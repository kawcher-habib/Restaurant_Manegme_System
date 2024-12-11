<?php


// Get All Data Function

function getAllData($conn, $tableName)
{

    $sql = "SELECT * FROM $tableName";

    if ($result = $conn->query($sql)) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return ['error' => 'Query Failed: ' . $conn->error];
    }

}

// Get Data By Id

function getDataById($conn, $tableName, $agentId)
{

    $stmt = $conn->prepare("SELECT * FROM $tableName WHERE agentId= ?");

    if (!$stmt) {

        return ['error' => 'Preparation Failed: ' . $conn->error];
    }

    $stmt->bind_param("s", $agentId);

    if ($stmt->execute()) {

        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        return !empty($data) ? $data : ['error' => 'No Data Found'];

    } else {
        return ['error' => 'Execute Failed: ' . $stmt->error];
    }
}

// Create New Data 

function createNew($conn, $tableName, $data)
{
    $stmt = $conn->prepare("INSERT INTO $tableName ('agentId', 'name', 'email', 'password', 'phone' )VALUES(?,?,?,?)");
    $stmt->bind_param('sssss', $data['agentId'], $data['name'], $data['email'], $data['password'], $data['phone']);
    if ($stmt->execute()) {
        http_response_code(200);
        return ['message' => 'New item create successfully'];
    } else {
        http_response_code(500);
        return ['message' => 'Failed to create New item'];
    }

}


//Update Data 

function updateData($conn, $tableName, $data,  $agentId){
    $sql = "UPDATE '$tableName' SET (name=?, email=?, password =?, phone = ? WHERE agentId= ?                                          ";
    $stmt = $conn->prepare($sql);
    if(!$stmt){
        http_response_code(500);
        return ['error'=> 'Preparation failed :'. $conn->error];
    }

    $stmt->bind_param('sssss', $data['name'], $data['email'], $data['password'], $data['phone'], $agentId);

    if($stmt->execute()){
        http_response_code(200);
        return ['message' => 'Data updated'];
    }else{
        http_response_code(500);
        return ['error'=>'Execute Failed : '. $stmt->error];
    }
}

//Delete Data

function deleteData($conn, $tableName, $agentId)
{

    //Validation No check
    $sql = "DELETE FROM '$tableName' WHERE agentId=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        http_response_code(500);
        return ['error' => 'Preparation Failed :' . $conn->error];
    }

    $stmt->bind_param('s', $agentId);

    if ($stmt->execute()) {

        http_response_code(200);
        return ['message' => 'Item delete successfully'];

    } else {

        http_response_code(500);
        return ['error' => 'Failed to delete :' . $stmt->error];

    }

}






?>