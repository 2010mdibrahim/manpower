<?php
include ('database.php');
$nid = $_POST['nid'];

$result = $conn->query("SELECT agent.agentName, agentexpense.* from agentexpense INNER JOIN agent using (agentEmail) where candidateNID = '$nid' or candidateBirthNumber = '$nid'");
$html = '';
if($result->num_rows != 0){
    $html .= '<table id="dataTableSeaum" class="table table-bordered table-hover"  style="width:100%">
                <thead>
                <tr>
                    <th>Agent Name</th>
                    <th>Candidate Name</th>
                    <th>Purpuse</th> 
                    <th>Amount</th>
                    <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>';
    while($candidate = mysqli_fetch_assoc($result)){
        $html .= "<tr>";
        $html .= "<td>".$candidate['agentName']."</td>";
        $html .= "<td>".$candidate['candidateName']."</td>";
        $html .= "<td>".$candidate['expensePurposeAgent']."</td>";
        $html .= "<td>".$candidate['fullAmount']."</td>";
        $html .= "<td>".$candidate['payDate']."</td>";
        $html .= "</tr>";
    }
    $html .= '</tbody>
                <tfoot>
                <tr hidden>
                    <th>Agent Name</th>
                    <th>Candidate Name</th>
                    <th>Purpuse</th> 
                    <th>Amount</th>
                    <th>Payment Date</th>
                </tr>
                </tfoot>
            </table> ';
}
echo $html;