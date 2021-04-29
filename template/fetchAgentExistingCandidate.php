<?php
include ('database.php');
$nid = $_POST['nid'];
$birthNumber = $_POST['birthNumber'];
$result = mysqli_fetch_assoc($conn->query("SELECT candidateName, candidateDOB, candidateNID, candidateBirthNumber from agentexpense where candidateNID = '$nid' OR candidateBirthNumber = '$birthNumber' LIMIT 1"));

if(!is_null($result)){
    $info = array(
        'nid' => $result['candidateNID'],
        'birthNumber' => $result['candidateBirthNumber'],
        'candidateName' => $result['candidateName'],
        'dob' => $result['candidateDOB']
    );
}else{
    $info = array(
        "nid" => $nid,
        "birthNumber" => $birthNumber,
        "candidateName" => "",
        "dob" => ""
    );
}
echo json_encode($info);